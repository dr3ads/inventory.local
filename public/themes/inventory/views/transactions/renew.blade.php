<h1>Additional Transaction</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-7">
        <div id="transaction-details">
            <div class="details-wrap">
                <h3>Transaction Details</h3>
                <div class="item-wrap">
                    <label>Customer: </label>
                    <div class="customer">{!! $transaction->customer->full_name !!}</div>
                </div>
                <div class="item-wrap">
                    <label>Pawned At: </label>
                    <div class="date">{!! date('M d, Y', strtotime($transaction->pawned_at)) !!}</div>
                </div>
                <div class="item-wrap">
                    <label>Total Pawn Amount: </label>
                    <div class="amount">{!! money_format('P %i',$totalAmount) !!}</div>
                </div>
                <div class="item-wrap">
                    <label>Expiry Date: </label>
                    <div class="date">{!! date('M d, Y', strtotime($transaction->expired_at)) !!}</div>
                </div>
            </div>
            <div class="details-wrap">
                <h3>Item Details</h3>
                <div class="item-wrap">
                    <label>Item Name: </label>
                    <div class="name">{!! $transaction->item->name !!}</div>
                </div>
                <div class="item-wrap">
                    <label>Item Description: </label>
                    <div class="description">{!! $transaction->item->description !!}</div>
                </div>
                <div class="item-wrap">
                    <label>Item Value: </label>
                    <div class="value">{!! money_format('P %i', $transaction->item->value) !!}</div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-wrap">
            {!! Form::open(['url' => 'transactions/renew']) !!}
            {!! Form::hidden('parent_id', $transaction->id) !!}
            {!! Form::hidden('customer_id',$transaction->customer_id); !!}
            {!! Form::hidden('item_id',$transaction->item_id); !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('pawn_amount', 'Renew Amount') !!}
                        <div class="item">{!! money_format('P %i', $totalAmount * (getenv('INTEREST_RATE') / 100)) !!}</div>
                    </div>
                    {!! Form::submit('Renew Transaction') !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
