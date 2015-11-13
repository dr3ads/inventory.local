<?php namespace Lib\Processes;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'process';
    protected $dates = ['renewed_at','expired_at'];

    //protected $fillable = ['fname', 'lname', 'age', 'phone', 'mobile'];

    protected function scopeExpired($query)
    {
        $query->where('expired_at', '!=', '');
    }

    protected function scopeRenewed($query)
    {
        $query->where('expired_at', '=', '')->where('renewed_at','!=','');
    }

}

