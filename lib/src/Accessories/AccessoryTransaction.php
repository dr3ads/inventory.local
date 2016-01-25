<?php

namespace Lib\Accessories;

use Illuminate\Database\Eloquent\Model;

class AccessoryTransaction extends Model
{
    protected $table = 'accessory_transactions';
    protected $fillable = ['type', 'amount', 'quantity', 'description'];

    public function accessory()
    {
        return $this->belongsTo('Lib\Accessories\Accessory');
    }

    public function scopeSold($query)
    {
        $query->where('type', '=', 'out');
    }
}
