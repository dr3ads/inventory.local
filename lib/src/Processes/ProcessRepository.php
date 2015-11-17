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
        return $this->model->initial()->get();
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
        return $this->model->where('id','=',$parentId)->orWhere('parent_id', '=', $parentId)->sum('pawn_amount');
    }

}