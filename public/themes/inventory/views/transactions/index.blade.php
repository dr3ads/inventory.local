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
            <div class="col-md-2"><a href="{!! url('transactions/create') !!}" >New Transaction</a></div>
            <div class="col-md-2 col-md-offset-8">
                <div id="form-filter-wrap">
                    {!! Form::open(array('method' => 'GET','id' => 'form-filter')) !!}
                        <div class="form-group">
                            {!! Form::label('status','Status') !!}
                            {!! Form::select('status', array('default' => 'Default', 'renewed' => 'Renewed', 'expired' => 'Expired'), $status) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
            <td>Control Number</td>
            <td>Customer</td>
            <td>Pawn Date</td>
            <td>Pawn Amount</td>
            <td>Renewal Date</td>
            <td>Expiry Date</td>
            <td colspan="3" align="center">Actions</td>
        </thead>
        @foreach($transactions as $transaction)
            <tr>
                <td>{!! $transaction['parent']->ctrl_number !!}</td>
                <td>{!! $transaction['parent']->customer->full_name !!}</td>
                <td>{!! date('Y-m-d', strtotime($transaction['lastChild']->pawned_at)) !!}</td>
                <td>P{!! $transaction['totalPawnAmount'] !!}</td>
                <td>{!! $transaction['parent']->renewed_at !!}</td>
                <td>{!! date('Y-m-d', strtotime($transaction['lastChild']->expired_at)) !!}</td>
                <td><a href="{!! url('transactions/show/'.$transaction['parent']->id) !!}">View Details</a></td>
                <td><a href="{!! url('transactions/repawn/'.$transaction['parent']->id) !!}">RePawn</a></td>
                <td><a href="{!! url('transactions/renew/'.$transaction['parent']->id) !!}">Renew</a></td>
            </tr>
        @endforeach
    </table>
</div>
