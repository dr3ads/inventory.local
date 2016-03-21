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

