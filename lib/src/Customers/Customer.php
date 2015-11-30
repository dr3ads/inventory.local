<?php namespace Lib\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $dates = ['deleted_at','valid_until'];
    protected $fillable = ['fname', 'lname', 'age', 'phone', 'mobile','photo','id_type','id_number','id_issuedby','valid_until'];

    public function getFullNameAttribute()
    {
        return $this->fname.' '.$this->lname;
    }

    public function transactions()
    {
        return $this->BelongsToMany('Lib\Processes\Process');
    }
}
