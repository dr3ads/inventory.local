<?php namespace Lib\Processes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    protected $table = 'processes';
    protected $dates = ['renewed_at', 'expired_at', 'pawned_at', 'claimed_at', 'deleted_at'];
    protected $fillable = [
        'type',
        'customer_id',
        'item_id',
        'pawn_amount',
        'pawned_at',
        'parent_id',
        'expired_at'
    ];
    protected $with = array('customer', 'item');

    use SoftDeletes;

    static public function boot()
    {
        static::created(function ($process) {
            $process->ctrl_number = getenv('BRANCH_ID') . $process->id;
            $process->update();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function accounting()
    {
        return $this->morphMany('Lib\Accounting\Accounting', 'accountable');
    }

    /**
     * @param $query
     */
    public function scopeInitial($query)
    {
        $query->where('parent_id', '=', 0);
    }

    /**
     * @param $query
     */
    public function scopeActive($query)
    {
        $query->where('status', '=', 'active');
    }

    /**
     * @param $query
     */
    public function scopeExpired($query)
    {
        $query->where('status', '=', 'expired');
    }

    /**
     * @param $query
     */
    public function scopeClaimed($query)
    {
        $query->where('status', '=', 'claimed');
    }

    /**
     * @param $query
     * @param $customer_id
     */
    public function scopeOfCustomer($query, $customer_id)
    {
        $query->where('customer_id', '=', $customer_id);
    }

    /**
     * @param $query
     */
    public function scopeVoid($query)
    {
        $query->where('status', '=', 'void');
    }

    /**
     * @param $query
     */
    public function scopeHold($query)
    {
        $query->where('status', '=', 'hold');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Lib\Processes\Process', 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->BelongsTo('Lib\Customers\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->BelongsTo('Lib\Items\Item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alert()
    {
        return $this->hasMany('Lib\Alerts\Alert');
    }

    public function parent()
    {
        return $this->hasOne('Lib\Processes\Process', 'id', 'parent_id');
    }
}

