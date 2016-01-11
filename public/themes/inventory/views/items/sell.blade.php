<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">

            <div class="page-title">
                Sell Item - {{ $item->name }}
            </div>
            <div class="item-details">
                <h2 class="item-name">{{ $item->name }}</h2>
                <div class="item-value">Item Value: P{{ $item->value }}</div>
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $item->brand }}</div>
            <div class="item-brand">{{ $item->serial }}</div>
            <div class="item-brand">{{ $item->description }}</div>
        </div>
        <hr />
        {!! Form::open(['route' => 'item.sell', 'class' => 'form-horizontal', 'id' => 'buy-item']) !!}
        {!! Form::hidden('item_id', $item->id) !!}
        <div class="form-group">
            <label for="customer_id" class="strong col-md-2"><i class="fa fa-user">&nbsp;</i>Customer Id *</label>
            <div class="col-md-10"> {!! Form::select('customer_id',$customers,'',array('class' => 'form-control chosen',
            'required' => 'required', 'data-prompt-position' => 'bottomRight:-100', 'id' => 'customer_id', 'placeholder' => ' ', 'data-placeholder' => 'Chose Customer')) !!}</div>
            <!--<p class="help-block">description for future use</p>-->
        </div>
        <div class="form-group">
            {!! Form::label('item_sell_price','Item Sell Price *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('item_sell_price',0,array('min' => 1, 'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>

        <div class="form-actions">
            {!! Form::submit('Sell Item', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('inventory') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>

