<div class="item-filter">
    <div class="controls">
        <a title="Buy Item" id="buy_item_link" href="{{ url('inventory/buy') }}" class="btn btn-new pull-left">
            <i class="fa fa-plus"></i> Buy Item
        </a>
        <a title="Sell Item" id="buy_item_link" href="{{ url('inventory/sell') }}" class="btn btn-new pull-left">
            <i class="fa fa-plus"></i> Sell Item
        </a>

    </div>
    <div class="status-filter">
        <div class="status-filter-wrap">
            <ul class="center-top-menu">
                <li @if(Input::get('type') == 'active' || Input::get('active') == '') class="active" @endif>
                    <a href="{{ url('inventory?type=active') }}"><span>Active</span> <span class="badge">0</span></a>
                </li>
                <li @if(Input::get('type') == 'void') class="active" @endif>
                    <a href="{{ url('inventory?type=void') }}"><span>Void</span> <span class="badge">0</span></a>
                </li>
                <li @if(Input::get('type') == 'bought') class="active" @endif>
                    <a href="{{ url('inventory?type=bought') }}"><span>Bought</span> <span class="badge">0</span></a>
                </li>
                <li @if(Input::get('type') == 'archive') class="active" @endif>
                    <a href="{{ url('inventory?type=archive') }}"><span>Archive</span> <span class="badge">0</span></a>
                </li>
            </ul>
        </div>
        <div class="item-details-filter">&nbsp;</div>
    </div>
</div>
