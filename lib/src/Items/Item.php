<?php

namespace Lib\Items;

use Illuminate\Database\Eloquent\Model;
use Lib\Processes\Process;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['name','description','value','is_onhold'];

    public function transaction()
    {
        return $this->hasOne('Lib\Processes\Process');
    }
}
