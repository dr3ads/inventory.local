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
                <span class="action">Renew</span>
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
            <div class="col-md-8 margin-top-10">
                <div class="repawn-form">
                    <h3>Display Transaction Item</h3>
                    {!! Form::open(['url' => 'transactions/display', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('parent_id', $transaction->id) !!}
                    {!! Form::hidden('customer_id',$transaction->customer_id) !!}
                    {!! Form::hidden('item_id',$transaction->item_id) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="acquire_price" class="strong col-md-3">Acquire Price *</label>
                                <div class="col-md-7"> {!! Form::number('acquire_price', 0 ,array('class' => 'form-control', 'required' => 'required')) !!}</div>
                                <!--<p class="help-block">description for future use</p>-->
                            </div>
                            <div class="form-group">
                                <label for="selling_price" class="strong col-md-3">Selling Price *</label>
                                <div class="col-md-7"> {!! Form::number('selling_price', 0 ,array('class' => 'form-control', 'required' => 'required')) !!}</div>
                                <!--<p class="help-block">description for future use</p>-->
                            </div>
                            <div class="form-group">

                            </div>
                            {!! Form::submit('Display Item', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>


