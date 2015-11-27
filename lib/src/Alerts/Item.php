<?php

namespace Lib\Items;

use Illuminate\Database\Eloquent\Model;
use Lib\Processes\Process;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['name','description','value','is_onhold'];

    public function process()
    {
        return $this->hasOne('Lib\Processes\Process');
    }

    public function scopeIsOnHand($query)
    {
        $query->where('is_onhand', '=', '1');
    }

    public function scopeIsOutHand($query)
    {
        $query->where('is_onhand', '!=', '1');
    }

}
