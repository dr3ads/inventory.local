<div class="content-wrapper">
    <div class="container-fluid">
        <div class="transaction-details">
            <div class="controls">
                @if($item->sold_at == null)
                    <a class="btn btn-default pull-left margin-left-20 link-tooltip"  data-placement="bottom" data-toggle="tooltip" title="Sell Item" href="{{ url('display/sell/'.$item->id) }}" id="sell_link" title="Sell">
                        <i class="fa fa-refresh"></i>Sell
                    </a>

                    <a class="btn btn-default pull-left margin-left-20 link-tooltip"  data-placement="bottom" data-toggle="tooltip" title="Pull Item" href="{{ url('display/pull/'.$item->id) }}" id="pull_link" title="Pull Out">
                        <i class="fa fa-refresh"></i>Pull
                    </a>
                @endif
                @if($item->process)
                    <a class="btn btn-default pull-left margin-left-20 link-tooltip" target="_blank"  data-placement="bottom" data-toggle="tooltip" title="View Transaction" href="{{ url('transactions/show/'.$item->process->id) }}" id="sell_link" title="Sell">
                        <i class="fa fa-refresh"></i>View Transaction
                    </a>
                @endif

            </div>
            <div class="page-title">
                {{ $item->name }}
            </div>
            <div class="item-details">
                <h2 class="item-name">{{ $item->name }}</h2>
                <div class="item-value">Acquire Price: P{{ $item->acquire_price }}</div>
                @if($item->sold_price > 0)
                    <div class="item-value">Sold Price: P{{ $item->sold_price }}</div>
                @endif
                @if($item->delivered_at != null)
                    <div class="item-value">Delivery Date: P{{ $item->delivered_at }}</div>
                @endif
                @if($item->sold_at != null)
                    <div class="item-value">Sold Date: {{ date('d M, Y',strtotime($item->sold_at)) }}</div>
                @endif
            </div>
        </div>

        <div class="item-additional-info">
            <div class="item-brand">{{ $item->brand }}</div>
            <div class="item-brand">{{ $item->serial }}</div>
            <div class="item-brand">{{ $item->description }}</div>
        </div>

    </div>
</div>

