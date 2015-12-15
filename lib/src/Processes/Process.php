<?php namespace Lib\Processes;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'processes';
    protected $dates = ['renewed_at','expired_at','pawned_at','claimed_at'];
    protected $fillable = ['customer_id','item_id','pawn_amount','pawned_at', 'parent_id','expired_at'];

    public function accounting()
    {
        return $this->morphMany('Lib\Accounting\Accounting','accountable');
    }

    public function scopeInitial($query)
    {
        $query->where('parent_id', '=', 0);
    }

    public function scopeActive($query)
    {
        $query->where('status','=','active');
    }

    public function scopeExpired($query)
    {
        $query->where('status', '=', 'expired');
    }

    public function scopeClaimed($query)
    {
        $query->where('status', '=', 'claimed');
    }

    public function scopeOfCustomer($query, $customer_id)
    {
        $query->where('customer_id', '=', $customer_id);
    }

    public function scopeVoid($query)
    {
        $query->where('status', '=', 'void');
    }


    protected function customer()
    {
        return $this->BelongsTo('Lib\Customers\Customer');
    }

    public function item()
    {
        return $this->BelongsTo('Lib\Items\Item');
    }

    static public function boot(){
        static::created(function( $process ){
            //$meal->meal_image_id = DB::table('media')->insertGetId(array());
            $process->ctrl_number = getenv('BRANCH_ID').$process->id;
            $process->update();
       });
    }

    public function alert()
    {
        return $this->hasMany('Lib\Alerts\Alert');
    }
}

