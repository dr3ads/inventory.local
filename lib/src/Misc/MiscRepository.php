<?php

namespace Lib\Misc;

use Lib\AbstractRepository;
use Lib\Misc\Misc;

class MiscRepository extends AbstractRepository
{
    public function __construct(Misc $transaction)
    {
        $this->model = $transaction;
    }


}