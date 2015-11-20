<?php namespace Lib\Items;

use Lib\AbstractRepository;
use Lib\Items\Item;

class ItemRepository extends AbstractRepository
{
    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    public function itemsOnhand()
    {
        return $this->model->isonhand()->get();
    }
    public function itemsOuthand()
    {
        return $this->model->isouthand()->get();
    }
}