<?php namespace Lib\Items;

use Lib\AbstractRepository;
use Lib\Items\Item;

class ItemRepository extends AbstractRepository
{
    public function __construct(Item $item)
    {
        $this->model = $item;
    }
}