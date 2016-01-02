<?php

namespace Lib\Misc;

use Lib\AbstractRepository;
use Lib\Misc\Misc;

class MiscRepository extends AbstractRepository
{
    public function __construct(Misc $misc)
    {
        $this->model = $misc;
    }

    public function getMiscByFlow($flow)
    {
        return $this->model->ofFlow($flow);
    }

    /*public function getTransactionStatusCount()
    {
        $data = array();

        $data['active'] = $this->model->where('status', '=', 'active')->count();
        $data['claimed'] = $this->model->where('status', '=', 'claimed')->count();
        $data['expired'] = $this->model->where('status', '=', 'expired')->count();
        $data['void'] = $this->model->where('status', '=', 'void')->count();
        $data['hold'] = $this->model->where('status', '=', 'hold')->count();

        return $data;
    }*/


}