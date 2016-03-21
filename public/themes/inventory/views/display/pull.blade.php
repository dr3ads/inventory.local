<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">

            <div class="page-title">
                Pull Item - {{ $item->name }}
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
        {!! Form::open(['route' => 'item.pull', 'class' => 'form-horizontal', 'id' => 'buy-item']) !!}
        {!! Form::hidden('item_id', $item->id) !!}
        <div class="form-group">
            <label for="customer_id" class="strong col-md-5 left-align"><i class="fa fa-warning">&nbsp;</i>Continue with item pull out?</label>
        </div>


        <div class="form-actions">
            {!! Form::submit('Pull Item', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('inventory') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>

