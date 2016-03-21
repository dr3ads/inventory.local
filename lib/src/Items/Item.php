<?php

namespace Lib\Items;

use Illuminate\Database\Eloquent\Model;
use Lib\Processes\Process;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';
    protected $fillable = [
        'name',
        'description',
        'value',
        'is_onhold',
        'serial',
        'brand',
        'sold_at',
        'displayed_at',
        'delivered_at',
        'acquire_price',
        'selling_value',
    ];
    protected $dates = ['deleted_at', 'sold_at', 'displayed_at', 'delivered_at'];

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

    public function scopeSold($query)
    {
        $query->whereNotNull('sold_at');
    }

    public function accounting()
    {
        return $this->morphMany('Lib\Accounting\Accounting', 'accountable');
    }

}
