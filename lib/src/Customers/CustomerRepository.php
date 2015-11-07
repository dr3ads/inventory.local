<?php namespace Lib\Customers;

use Lib\AbstractRepository;
use Lib\Customers\Customer;

class CustomerRepository extends AbstractRepository
{
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }
}