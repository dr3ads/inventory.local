<?php

namespace Lib\Accessories;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $table = 'accessories';
    protected $fillable = ['name','description','quantity','unit_price'];

    public function transactions()
    {
        return $this->hasMany('Lib\Accessories\AccessoryTransaction');
    }
}
