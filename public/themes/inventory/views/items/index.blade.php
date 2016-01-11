<div class="content-wrapper">
    <div class="container-fluid">
        {!! Theme::widget('itemfilter', array('items' => $items))->render() !!}
        <div class="list-misc-holder row">
            @if(isset($items) && count($items) > 0)
                <ul class="list-miscs">
                    @foreach($items as $item)
                        <li>
                            <div class="misc-info-wrap">
                                <a class="misc-info" href="{{url('inventory/show/'.$item->id)}}">
                                    {{ $item->name }} &#183;
                                    {{ $item->brand }} &#183;
                                    {{ $item->serial }}
                                    @if($item->process) &#183;{{ $item->process->ctrl_number }} @endif
                                </a>
                            </div>
                            <div class="misc-details">
                                <div class="misc-description">{!! $item->description !!}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination-wrap">
                    {!! $items->render() !!}
                </div>
            @endif

        </div>
    </div>
</div>

