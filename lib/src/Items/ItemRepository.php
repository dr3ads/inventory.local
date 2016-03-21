<?php namespace Lib\Items;

use Lib\AbstractRepository;
use Lib\Items\Item;
use Carbon\Carbon;

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

    public function getActiveDisplay()
    {
        return $this->model->whereNotNull('displayed_at')->whereNull('sold_at')->paginate();
    }

    public function getSold()
    {
        return $this->model->whereNotNull('sold_at')->paginate();
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

    public function itemCount()
    {
        $data = array(
            'active' => $this->model->whereHas('process', function($query){
                $query->whereNotIn('status', ['void','hold'])->where('parent_id', '=', '0');
            })->count(),
            'void' => $this->model->whereHas('process', function($query){
                $query->whereIn('status', ['void','hold'])->where('parent_id', '=', '0');
            })->count(),
            'bought' => $this->model->doesntHave('process')->count(),
            'archive' => $this->model->onlyTrashed()->count(),
        );

        return $data;
    }

    public function displayItemCount()
    {
        $data = array(
            'active' => $this->model->whereNotNull('displayed_at')->whereNull('sold_at')->count(),
            'sold' => $this->model->whereNotNull('sold_at')->count(),
        );

        return $data;
    }

    public function getTodaySoldUnits()
    {
        return $this->model->sold()->whereRaw('DATE(sold_at) = ?', [Carbon::now()->format('Y-m-d')] )->get();
    }

    public function getTodayBoughtUnits()
    {
        return $this->model->doesntHave('process')->whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->get();
    }

    public function getDisplayItems()
    {
        /*return $this->model->whereHas('process', function($query){
            $query->whereNotIn('status', ['void','hold'])->where('parent_id', '=', '0');
        })->paginate();*/


        return $this->model->whereNotNull('displayed_at')->paginate();
    }
}

