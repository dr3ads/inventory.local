<?php

namespace Lib\Alerts;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'alerts';
    protected $fillable = ['process_id','added_at'];
    protected $dates = ['added_at'];
    protected $dateFormat = 'Y-m-d';

    public function process()
    {
        return $this->belongsTo('Lib\Processes\Process');
    }
}
