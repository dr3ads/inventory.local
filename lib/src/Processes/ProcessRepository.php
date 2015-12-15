<?php

namespace Lib\Processes;

use Carbon\Carbon;
use Lib\AbstractRepository;
use Lib\Alerts\Alert;
use Lib\Alerts\AlertRepository;
use Lib\Processes\Process;

class ProcessRepository extends AbstractRepository
{
    protected $alertRepository;

    public function __construct(Process $transaction, AlertRepository $alertRepository)
    {
        $this->model = $transaction;
        $this->alertRepository = $alertRepository;
    }

    public function allExpired()
    {
        return $this->model->initial()->expired();
    }

    public function allClaimed()
    {
        return $this->model->initial()->claimed();
    }

    public function allVoid()
    {
        return $this->model->initial()->void();
    }

    public function allParents()
    {
        return $this->model->initial()->active();
    }

    public function getAllTree($parentId)
    {
        $data = array();

        $data[] = $this->model->find($parentId);
        $children = $this->model->where('parent_id', '=', $parentId)->get();

        foreach ($children as $child) {
            $data[] = $child;
        }

        return $data;
    }

    /**
     * Check proccesses and create the necessary alerts
     *
     */
    public function setExpirableAlerts()
    {
        $allParents = $this->model->initial()->active()->get();

        foreach ($allParents as $parent) {
            $processTree = $this->getProcessTree($parent->id);

            $expiryDate = strtotime($processTree['lastChild']->expired_at);

            if (Carbon::now()->diffInDays(Carbon::createFromTimestampUTC($expiryDate)) < getenv('ALERT_DAY_COUNT')) {
                if ($this->alertRepository->checkAlertExisting($parent->id) <= 0) {
                    $this->alertRepository->create(array('process_id' => $parent->id));
                }
            }
        }
    }

    public function getProcessTree($parentId)
    {

        $data = array(
            'parent' => $this->model->find($parentId),
            'lastChild' => ($this->lastChild('parent_id', $parentId)) ? $this->lastChild('parent_id',
                $parentId) : $this->model->find($parentId),
            'totalPawnAmount' => $this->getTotalPawnAmount($parentId),
            'relatedTransactionCount' => $this->getRelatedTransactionsCount($parentId),
        );

        return $data;
    }

    public function lastChild($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->orderBy('id', 'desc')->first($columns);
    }

    public function getTotalPawnAmount($parentId)
    {
        return $this->model->where('id', '=', $parentId)->orWhere('parent_id', '=', $parentId)->sum('pawn_amount');
    }

    /**
     * get the number of related transactions
     *
     * @param $id
     * @return mixed
     */
    protected function getRelatedTransactionsCount($id)
    {
        return $this->model->where('id', '=', $id)->orWhere('parent_id', '=', $id)->count();
    }

    public function setProcessVoid()
    {
        $allParents = $this->model->initial()->expired()->get();

        foreach ($allParents as $parent) {
            $processTree = $this->getProcessTree($parent->id);

            $expiryDate = strtotime($processTree['lastChild']->expired_at);

            if (Carbon::now()->diffInDays(Carbon::createFromTimestampUTC($expiryDate)) >= getenv('VOID_COUNT')) {
                $this->setProcessStatus($parent->id, 'void');
            }
        }
    }

    /**
     * Set the status of the process and its child
     * @param $processId
     * @param string $status
     * @return bool
     */
    public function setProcessStatus($processId, $status = 'claimed')
    {
        $this->update(array('status' => $status, 'claimed_at' => Carbon::now()), $processId);
        $this->update(array('status' => $status, 'claimed_at' => Carbon::now()), $processId, 'parent_id');

        return true;
    }

    public function transactionDetails($id)
    {
        $data = array(
            'totalPawnAmount' => $this->getTotalPawnAmount($id),
            'totalPrincipal' => $this->getTotalPawnAmount($id) - ($this->getTotalPawnAmount($id) * (getenv('INTEREST_RATE') / 100)),
            'processPenalty' => ($this->getAfterExpiryDayCount($id,
                    Carbon::now()) > 0) ? $this->calculatePenaltyPercentage($this->getAfterExpiryDayCount($id,
                Carbon::now())) : 0,
        );
        return $data;
    }

    protected function getAfterExpiryDayCount($id, Carbon $toDate)
    {
        $transaction = $this->find($id);
        $expiryDate = Carbon::instance($transaction->expired_at);

        return $expiryDate->diffInDays($toDate, false);
    }

    protected function calculatePenaltyPercentage($days = 1)
    {
        if ($days <= 0) {
            return 0;
        }
        $initialPenalty = getenv('INITIAL_PENALTY');
        $initialPenaltyDays = getenv('INITIAL_PENALTY_DAYS');
        $normalPenalty = getenv('NORMAL_PENALTY');

        return (($days - $initialPenaltyDays) * $normalPenalty) + ($initialPenalty * $initialPenaltyDays);
    }

    public function getTransactionStatusCount()
    {
        $data = array();

        $data['active'] = $this->model->where('status', '=', 'active')->count();
        $data['claimed'] = $this->model->where('status', '=', 'claimed')->count();
        $data['expired'] = $this->model->where('status', '=', 'expired')->count();
        $data['void'] = $this->model->where('status', '=', 'void')->count();
        $data['hold'] = $this->model->where('status', '=', 'hold')->count();

        return $data;
    }

}