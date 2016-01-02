<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

<div class="content-wrapper">
    <div class="container-fluid">
        {!! Theme::widget('miscfilter', array('miscs' => $miscs, 'count' => $count))->render() !!}
        <div class="list-misc-holder row">
            @if(isset($miscs) && count($miscs) > 0)
                <ul class="list-miscs">
                    @foreach($miscs as $misc)
                        <li>
                            <div class="misc-info-wrap">
                                <a class="misc-info" href="#">
                                    {{ $misc->type }} &#183;
                                    {{ $misc->amount }} &#183;
                                    {{ date('M d, Y', strtotime($misc->created_at))  }}
                                </a>
                            </div>
                            <div class="misc-details">
                                <div class="misc-description">{!! $misc->description !!}</div>

                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination-wrap">
                    {!! $miscs->render() !!}
                </div>
            @else
            @endif

        </div>
    </div>
</div>

