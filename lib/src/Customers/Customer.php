<?php namespace Lib\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];
    protected $fillable = ['fname', 'lname', 'age', 'phone', 'mobile'];

    public function getFullNameAttribute()
    {
        return $this->fname.' '.$this->lname;
    }

    public function transactions()
    {
        return $this->BelongsToMany('Lib\Processes\Process');
    }
}
