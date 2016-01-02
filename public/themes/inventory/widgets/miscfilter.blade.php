<div class="misc-filter">
    <div class="controls">
        <a title="New Earn" id="new_earn_link" href="{{ url('misc/earn') }}" class="btn btn-new pull-left"><i class="fa fa-plus"></i>
            Cash In
        </a>
        <a title="New Spend" id="new_spend_link" href="{{ url('misc/spend') }}" class="btn btn-new pull-left"><i class="fa fa-plus"></i>
            Cash Spend
        </a>
    </div>
    <div class="status-filter">
        <div class="status-filter-wrap">
            <ul class="center-top-menu">
                <li @if(Input::get('flow') == 'in' || Input::get('flow') == '') class="active" @endif>
                    <a href="{{ url('misc?flow=in') }}"><span>Earn</span> <span class="badge">{!! $count['earn'] !!}</span></a>
                </li>
                <li @if(Input::get('flow') == 'out') class="active" @endif>
                    <a href="{{ url('misc?flow=out') }}"><span>Spent</span> <span class="badge">{!! $count['spend'] !!}</span></a>
                </li>
            </ul>
        </div>
        <div class="trans-details-filter">&nbsp;</div>
    </div>
</div>
