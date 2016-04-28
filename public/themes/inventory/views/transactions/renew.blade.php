<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                <a class="btn btn-default pull-left margin-left-20 link-tooltip" data-placement="bottom" data-toggle="tooltip" title="Cancel Renew" href="{{ url('transactions/show/'.$transaction->id) }}" id="repawn_link" title="Repawn">
                    <i class="fa fa-undo"></i>Cancel
                </a>
            </div>
            <div class="page-title">
                <a class="trans-status btn btn-primary" title="Status: {{ ucfirst($transaction->status) }}">{!! ucfirst($transaction->status) !!}</a>
                <span class="customer">Customer:  {{ $transaction->customer->full_name }}</span> &#183;
                <span class="customer">Expiry:  {{ date('M d, Y', strtotime($transaction->expired_at)) }}</span> &#183;
                <span class="action">Renew</span>
            </div>
            <div class="item-details">
                <h2 class="item-name">{{ $transaction->item->name }}</h2>
                <div class="item-value">Item Value: P{{ $transaction->item->value }}</div>
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $transaction->item->brand }}</div>
            <div class="item-brand">{{ $transaction->item->serial }}</div>
            <div class="item-brand">{{ $transaction->item->description }}</div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="repawn-form">
                    <h3>Process Renew</h3>
                    {!! Form::open(['url' => 'transactions/renew', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('parent_id', ($transaction->parent_id) ?: $transaction->id) !!}
                    {!! Form::hidden('customer_id',$transaction->customer_id) !!}
                    {!! Form::hidden('item_id',$transaction->item_id) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('pawn_amount', 'Renew Amount *', array('class' => 'strong col-md-5')) !!}
                                <div class="col-md-7">{!! Form::number('pawn_amount', number_format($transaction->pawn_amount * (getenv('INTEREST_RATE') / 100), 2 ), array('readonly' => 'readonly', 'class' => 'form-control')) !!}</div>

                            </div>
                            {!! Form::submit('Renew Transaction', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="renew-details">
                    <h3>Renew Details</h3>
                    <div class="form-group">
                        {!! Form::label('pawn_amount', 'Total Amount') !!}
                        <div class="item">{!! money_format('P %i', $transaction->pawn_amount) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('repawnable_amount', 'Repawn Max Amount') !!}
                        <div class="pawnable-amount">{!! money_format('P %i', $transaction->item->value - $transaction->pawn_amount) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('expiry_date', 'Expiry Date') !!}
                        <div class="date">{!! \Carbon\Carbon::now()->addDays(getenv('EXPIRY_COUNT'))->format('M d, Y')!!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


