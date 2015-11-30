<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Transactions</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2"><a href="{{ url('transactions/create') }}" >New Transaction</a></div>

        </div>
    </div>

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
            <td>Control Number</td>
            <td>Customer</td>
            <td>Pawn Date</td>
            <td>Pawn Amount</td>
            <td>Claim Date</td>
            <td align="center"></td>
        </thead>
        @if(isset($transactions) && count($transactions) > 0)
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction['parent']->ctrl_number }}</td>
                <td>{{ $transaction['parent']->customer->full_name }}</td>
                <td>{{ date('Y-m-d', strtotime($transaction['lastChild']->pawned_at)) }}</td>
                <td>P{{ $transaction['totalPawnAmount'] }}</td>
                <td>{{ date('M d, Y', strtotime($transaction['parent']->claimed_at)) }}</td>
                <td><a href="{{ url('transactions/show_all/'.$transaction['parent']->id) }}">View Details</a></td>

            </tr>
        @endforeach
        @endif
    </table>
    {!! $paginator !!}
</div>
