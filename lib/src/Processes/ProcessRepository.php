<?php

namespace Lib\Processes;

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
        return $this->model->expired()->get();
    }

    public function allRenewed()
    {
        return $this->model->renewed()->get();
    }

    public function allParents()
    {
        return $this->model->initial()->paginate();
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
        $children = $this->model->where('parent_id',$parentId);
        foreach($children as $child){
            $data['children'][] = $child;

        }
        $data['parent'] = $this->model->find($parentId);

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
        $this->model->update(array('status' => $status), $processId);
        $this->model->update(array('status' => $status), $processId, 'parent_id');

        return true;
    }

}