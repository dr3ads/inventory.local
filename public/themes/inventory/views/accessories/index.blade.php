<div class="content-wrapper">
    <div class="container-fluid">
        {!! Theme::widget('accessoryfilter')->render() !!}
        <div class="list-misc-holder row">
            @if(isset($accessories) && count($accessories) > 0)
                <ul class="list-miscs">
                    @foreach($accessories as $accessory)
                        <li>
                            <div class="misc-info-wrap">
                                <a class="misc-info" href="{{url('accessories/show/'.$accessory->id)}}">
                                    {{ $accessory->name }}
                                </a>
                            </div>
                            <div class="misc-details">
                                <div class="misc-description">{!! $accessory->description !!}</div>
                                <div class="misc-description">Unit Price: P{!! $accessory->unit_price !!}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination-wrap">
                    {!! $accessories->render() !!}
                </div>
            @endif

        </div>
    </div>
</div>

