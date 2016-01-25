<?php

namespace Lib\Misc;

use Lib\AbstractRepository;
use Lib\Misc\Misc;
use Carbon\Carbon;

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

    public function getTodayCashIn()
    {
        return $this->model->ofFlow('in')->whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->get();
    }
    public function getTodayCashOut()
    {
        return $this->model->ofFlow('out')->whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->get();
    }


}