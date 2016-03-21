<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="content-wrapper">
    <div class="container-fluid">
        {!! Theme::widget('displayfilter', array('items' => $items, 'count' => $count))->render() !!}
        <div class="list-misc-holder row">
            @if(isset($items) && count($items) > 0)
                <ul class="list-miscs">
                    @foreach($items as $item)
                        <li>
                            <div class="misc-info-wrap">
                                <a class="misc-info inline" href="{{url('display/show/'.$item->id)}}">
                                    {{ $item->name }} &#183;
                                    {{ $item->brand }} &#183;
                                    {{ $item->serial }}
                                    @if($item->process) &#183;{{ $item->process->ctrl_number }} @endif
                                </a>
                            </div>
                            <div class="misc-details">
                                <div class="misc-description inline">{!! $item->description !!}</div>
                                <div class="pull-right light">
                                    <div class="expiry-date">Display Price: P{{  $item->selling_value }}</div>
                                </div>
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

