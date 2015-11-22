<?php namespace Lib\Accounting;

use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    protected $table = 'accounting';
    protected $fillable = ['amount','accountable_type','accountable_id','type'];

    public function accountable()
    {
        return $this->morphTo();
    }
}

