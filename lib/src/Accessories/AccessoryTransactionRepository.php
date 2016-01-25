<?php

namespace Lib\Accessories;

use Lib\AbstractRepository;
use Lib\Accessories\AccessoryTransaction;
use Carbon\Carbon;

class AccessoryTransactionRepository extends AbstractRepository
{
    public function __construct(AccessoryTransaction $accessoryTransaction)
    {
        $this->model = $accessoryTransaction;
    }

    public function getTodaySoldAccessories()
    {
     return $this->model->sold()->whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->get();
    }
}