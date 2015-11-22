<h1>Repawn</h1>

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
                <div class="item-wrap">
                    <label>Remaining Loanable Amount: </label>
                    <div class="value">{!! money_format('P %i', $transaction->item->value - $totalAmount) !!}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-wrap">
            <h3>Additional Pawn Details</h3>
            {!! Form::open(['url' => 'transactions/repawn']) !!}
            {!! Form::hidden('parent_id', $transaction->id) !!}
            {!! Form::hidden('customer_id',$transaction->customer_id); !!}
            {!! Form::hidden('item_id',$transaction->item_id); !!}
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        {!! Form::label('pawn_amount', 'Additional Amount') !!}
                        {!! Form::number('pawn_amount', ($transaction->item->value - $totalAmount), array('min' => 1, 'step' => 'any', 'max' => ($transaction->item->value - $totalAmount))) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('expiry_date', 'Expiry Date') !!}
                        <div class="date">{!! \Carbon\Carbon::now()->addDays(getenv('EXPIRY_COUNT'))->format('M d, Y')!!}</div>
                    </div>

                    {!! Form::submit('Create Transaction') !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


