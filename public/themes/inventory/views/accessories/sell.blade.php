
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                &nbsp;
            </div>
            <div class="page-title">
                {{ $accessory->name }}
            </div>
            <div class="item-details">
                <h2 class="item-name">Unit Price: P{{ $accessory->unit_price }}</h2>
                <div class="item-value">Quantity: {{ $accessory->value }}</div>
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $accessory->description }}</div>

        </div>
        <hr />
        {!! Form::open(['route' => 'accessories.sell', 'class' => 'form-horizontal', 'id' => 'sell-accessories']) !!}
        {!! Form::hidden('accessory_id', $accessory->id) !!}

        <div class="form-group">
            {!! Form::label('quantity','Quantity *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('quantity',0,array('min' => 1, 'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('amount','Accessory Sell Price *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('amount',0,array('min' => 1, 'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>

        <div class="form-actions">
            {!! Form::submit('Sell Accessory', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('accessories') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}

    </div>
</div>

