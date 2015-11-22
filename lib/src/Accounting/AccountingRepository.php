<?php

namespace Lib\Accounting;

use Lib\AbstractRepository;
use Lib\Accounting\Accounting;

class AccountingRepository extends AbstractRepository
{
    public function __construct(Accounting $accounting)
    {
        $this->model = $accounting;
    }

}