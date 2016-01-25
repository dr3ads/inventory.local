<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                <a class="btn btn-default pull-left margin-left-20 link-tooltip" data-placement="bottom"
                   data-toggle="tooltip" title="Cancel Renew"
                   href="{{ url('transactions/show/'.$processTree['parent']->id) }}" id="repawn_link" title="Repawn">
                    <i class="fa fa-undo"></i>Cancel
                </a>
            </div>
            <div class="page-title">
                <a class="trans-status btn btn-primary"
                   title="Status: {{ ucfirst($processTree['parent']->status) }}">{!! ucfirst($processTree['parent']->status) !!}</a>
                <span class="customer">Customer: {{ $processTree['parent']->customer->full_name }}</span> &#183;
                <span class="customer">Expiry: {{ date('M d, Y', strtotime($processTree['lastChild']->expired_at)) }}</span>
                &#183;
                <span class="action">Claim</span>
            </div>
            <div class="item-details">
                <h2 class="item-name">{{ $processTree['parent']->item->name }}</h2>
                <div class="item-value">Item Value: P{{ $processTree['parent']->item->value }}</div>
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $processTree['parent']->item->brand }}</div>
            <div class="item-brand">{{ $processTree['parent']->item->serial }}</div>
            <div class="item-brand">{{ $processTree['parent']->item->description }}</div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="transaction-tree">
                    <ul id="trans-list">
                        @foreach($children as $child)
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="trans-details">
                                            <span class="ctrl-number">#{{ $child->ctrl_number }}</span> &#183;
                                            <span class="trans-type">{{ ucfirst($child->type) }}</span> &#183;
                                            <span class="trans-amount">P{{ $child->pawn_amount }}</span>
                                        </div>
                                        <div class="trans-timeline">
                                            <span class="trans-date">{{ date('M d, Y', strtotime($child->pawned_at)) }}</span>
                                        </div>
                                        <div class="trans-actions pull-right">
                                            <a href="#" class="link-tooltip" title="Print Reciept"><i
                                                        class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="hold-form">
                    <h3>Hold Transaction</h3>
                    {!! Form::open(['url' => 'transactions/hold', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('parent_id', $transaction->id) !!}
                    {!! Form::hidden('customer_id',$transaction->customer_id); !!}
                    {!! Form::hidden('item_id',$transaction->item_id); !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('void_at', 'Hold Until', array('class' => 'col-md-5')) !!}
                                <div class="col-md-7">
                                    {!! Form::text('void_at','', array('class' => 'form-control date-picker', 'readonly' => 'readonly')) !!}
                                    <div class="sub-label">
                                        {!! Form::checkbox('hold-unli', '1', false, array('class' => 'inline', 'id' => 'hold-unli')) !!}
                                        {!! Form::label('hold-unli', 'Hold Indefinitely', array('class' => 'inline')) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::submit('Hold', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="claim-details">
                    <h3>Details</h3>
                    <div class="form-group">
                        {!! Form::label('pawn_amount', 'Total Amount') !!}
                        <div class="item">{!! money_format('P %i', $transactionDetails['totalPawnAmount']) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('repawnable_amount', 'Repawn Max Amount') !!}
                        <div class="pawnable-amount">{!! money_format('P %i', $transaction->item->value - $totalAmount) !!}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('void_date', 'Void Date') !!}
                        <div class="date">{!! \Carbon\Carbon::parse($transaction->expired_at)->addDays(getenv('VOID_COUNT'))->format('M d, Y')!!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








