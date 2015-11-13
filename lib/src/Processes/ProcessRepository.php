<?php namespace Lib\Processes;

use Lib\AbstractRepository;
use Lib\Processes\Process;

class ProcessRepository extends AbstractRepository
{
    public function __construct(Process $transaction)
    {
        $this->model = $transaction;
    }
}