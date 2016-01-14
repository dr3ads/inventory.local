<?php

namespace Lib\Accessories;

use Lib\AbstractRepository;
use Lib\Accessories\Accessory;

class AccessoryRepository extends AbstractRepository
{
    public function __construct(Accessory $accessory)
    {
        $this->model = $accessory;
    }

}