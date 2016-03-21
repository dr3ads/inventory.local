<div class="item-filter">
    <div class="controls">
        <a title="Buy Item" id="buy_item_link" href="{{ url('inventory/buy') }}" class="btn btn-new pull-left">
            <i class="fa fa-plus"></i> Buy Item
        </a>

    </div>
    <div class="status-filter">
        <div class="status-filter-wrap">
            <ul class="center-top-menu">
               <li @if(Input::get('type') == 'active' || Input::get('type') == '') class="active" @endif>
                    <a href="{{ url('display?type=active') }}"><span>Active</span> <span class="badge">{{ $count['active'] }}</span></a>
                </li>
                <li @if(Input::get('type') == 'sold') class="active" @endif>
                    <a href="{{ url('display?type=sold') }}"><span>Sold</span> <span class="badge">{{ $count['sold'] }}</span></a>
                </li>
            </ul>
        </div>
        <div class="item-details-filter">&nbsp;</div>
    </div>
</div>
