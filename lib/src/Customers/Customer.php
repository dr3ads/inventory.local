<?php namespace Lib\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['fname', 'lname', 'age', 'phone', 'mobile'];
}
