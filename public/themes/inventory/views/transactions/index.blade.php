<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

<div class="content-wrapper">
    <div class="container-fluid">
        {!! Theme::widget('transfilter', array('customers' => $customers, 'transactionsStatusCount' => $transactionsStatusCount))->render() !!}

        <div class="list-trans-holder row">
            @if(isset($transactions) && count($transactions) > 0)
                <ul class="list-trans">
                @foreach($transactions as $transaction)
                    <li>
                        <div class="trans-info">
                            <a class="trans-ctrlnumber" href="{{ url('transactions/show/'.$transaction['parent']->id) }}">
                                {!! $transaction['parent']->ctrl_number !!} -
                                {!! $transaction['parent']->item->name  !!}
                            </a>
                            <div class="pull-right light">
                                <span class="issue-no-comments" title="Number of Transactions"><i class="fa fa-book"></i>{!! $transaction['relatedTransactionCount'] !!}</span>
                            </div>
                        </div>
                        <div class="trans-details">
                            <div class="trans-date inline">{!! date('M d, Y', strtotime($transaction['lastChild']->pawned_at)) !!}</div>
                            <div class="customer inline">by: {!! $transaction['parent']->customer->full_name !!}</div>
                            <div class="pull-right light">
                                <div class="expiry-date">Expiry Date: {!! date('M d, Y', strtotime($transaction['lastChild']->expired_at)) !!}</div>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
                {{ $paginator }}
            @else
            @endif

        </div>
    {{--@foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction['parent']->ctrl_number }}</td>
            <td>{{ $transaction['parent']->customer->full_name }}</td>
            <td>{{ date('Y-m-d', strtotime($transaction['lastChild']->pawned_at)) }}</td>
            <td>P{{ $transaction['totalPawnAmount'] }}</td>
            <td>{{ date('Y-m-d', strtotime($transaction['lastChild']->expired_at)) }}</td>
            <td><a href="{{ url('transactions/show/'.$transaction['parent']->id) }}">View Details</a></td>
            <td>@if($transaction['parent']->item->value > $transaction['totalPawnAmount'])<a href="{{ url('transactions/repawn/'.$transaction['parent']->id) }}">RePawn</a>@else N/A @endif</td>
            <td><a href="{{ url('transactions/renew/'.$transaction['parent']->id) }}">Renew</a></td>
            <td><a href="{{ url('transactions/claim/'.$transaction['parent']->id) }}">Claim</a></td>
        </tr>
    @endforeach
    @else
        <h3>No transactions found</h3>
    @endif--}}
</div>
