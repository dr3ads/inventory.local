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

    public function getActive()
    {
        return $this->model->whereHas('process', function($query){
            $query->whereNotIn('status', ['void','hold'])->where('parent_id', '=', '0');
        })->paginate();
    }

    public function getVoid()
    {
        return $this->model->whereHas('process', function($query){
            $query->whereIn('status', ['void','hold'])->where('parent_id', '=', '0');
        })->paginate();
    }

    public function getBought()
    {
        return $this->model->doesntHave('process')->paginate();
    }

    public function getArchive()
    {
        return $this->model->onlyTrashed()->paginate();
    }

    public function getSellable()
    {
        $items = $this->model->doesntHave('process')->orWhereHas('process', function($query){
            $query->whereIn('status', ['void'])->where('parent_id', '=', '0');
        })->WhereNull('sold_at')->get()->toArray();

        $data = array();
        foreach($items as $item){
            $data[$item['id']] = $item['name'].' - '.$item['serial'];
        }

        return $data;
    }
}

