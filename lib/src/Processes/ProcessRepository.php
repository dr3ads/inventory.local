<?php

namespace Lib\Processes;

use Carbon\Carbon;
use Lib\AbstractRepository;
use Lib\Processes\Process;

class ProcessRepository extends AbstractRepository
{
    public function __construct(Process $transaction)
    {
        $this->model = $transaction;
    }

    public function allExpired()
    {
        return $this->model->initial()->expired()->paginate();
    }

    public function allClaimed()
    {
        return $this->model->initial()->claimed()->paginate();
    }

    public function allParents()
    {
        return $this->model->initial()->active()->paginate();
    }


    public function getProcessTree($parentId)
    {
        $data = array(
            'parent' => $this->model->find($parentId),
            'lastChild' => ($this->lastChild('parent_id', $parentId)) ? $this->lastChild('parent_id',
                $parentId) : $this->model->find($parentId),
            'totalPawnAmount' => $this->getTotalPawnAmount($parentId),
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

    public function getAllTree($parentId)
    {
        $data = array();

        $data[] = $this->model->find($parentId);
        $children = $this->model->where('parent_id','=', $parentId)->get();

        foreach ($children as $child) {
            $data[] = $child;
        }

        return $data;
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

}