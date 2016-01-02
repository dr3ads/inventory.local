<?php namespace Lib\Misc;

use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    protected $table = 'miscs';

    protected $fillable = ['flow', 'type', 'description'];

    public function accounting()
    {
        return $this->morphMany('Lib\Accounting\Accounting','accountable');
    }

    public function scopeOfFlow($query, $flow)
    {
        return $query->where('flow', '=', $flow);
    }
}

