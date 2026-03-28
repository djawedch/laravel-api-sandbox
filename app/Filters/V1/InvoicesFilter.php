<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter
{
    protected $safeParms = [
        'customer_id' => ['eq'],
        'amount' => ['eq', 'gt', 'lt'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'gt', 'lt'],
        'paid_date' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'ne' => '!='
    ];
}