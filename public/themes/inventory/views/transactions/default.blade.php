<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

<div class="content-wrapper">
    {!! Theme::widget('transfilter', array('customers' => $customers))->render() !!}
</div>

<div class="panel pan">

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
            <td>Control Number</td>
            <td>Customer</td>
            <td>Pawn Date</td>
            <td>Pawn Amount</td>
            <td>Expiry Date</td>
            <td colspan="3" align="center">Actions</td>
        </thead>
        @if(isset($transactions) && count($transactions) > 0)
        @foreach($transactions as $transaction)
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
        @endif
    </table>
    {{ $paginator }}
</div>
