<?php

namespace Lib\Items;

use Illuminate\Database\Eloquent\Model;
use Lib\Processes\Process;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';
    protected $fillable = ['name','description','value','is_onhold','serial','brand'];

    public function process()
    {
        return $this->hasOne('Lib\Processes\Process');
    }

    public function buyer()
    {
        return $this->BelongsTo('Lib\Customers\Customer');
    }

    public function scopeIsOnHand($query)
    {
        $query->where('is_onhand', '=', '1');
    }

    public function scopeIsOutHand($query)
    {
        $query->where('is_onhand', '!=', '1');
    }

    /*public function scopeHasProcess($query)
    {
        $query->where('process');
    }*/

}
