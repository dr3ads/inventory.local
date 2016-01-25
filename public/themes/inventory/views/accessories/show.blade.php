<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                <a class="btn btn-default pull-left margin-left-20 link-tooltip"  data-placement="bottom" data-toggle="tooltip" title="Sell Item" href="{{ url('accessories/sell/'.$accessory->id) }}" id="sell_link" title="Sell">
                    <i class="fa fa-refresh"></i>Sell
                </a>
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

    </div>
 </div>

