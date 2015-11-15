<?php namespace Lib\Processes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'processes';
    protected $dates = ['renewed_at','expired_at','pawned_at','claimed_at'];
    protected $fillable = ['customer_id','item_id','pawn_amount','pawned_at'];


    /*public function setPawnedAtAttribute( $date ){
        $this->attributes['pawned_at'] = Carbon::crea;
    }*/

    public function scopeExpired($query)
    {
        $query->where('expired_at', '!=', '');
    }

    public function scopeRenewed($query)
    {
        $query->where('expired_at', '=', '')->where('renewed_at','!=','');
    }

    protected function customer()
    {
        return $this->BelongsTo('Lib\Customers\Customer');
    }

    static public function boot(){
        static::created(function( $process ){
            //$meal->meal_image_id = DB::table('media')->insertGetId(array());
            $process->ctrl_number = getenv('BRANCH_ID').$process->id;
            $process->update();
        });
    }
}

