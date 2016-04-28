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
        {!! Theme::widget('transfilter', array('customers' => $customers, 'transactionsStatusCount' => $transactionsStatusCount))->render() !!}
        <div class="list-trans-holder row">
            @if(isset($transactions) && count($transactions) > 0)
                <ul class="list-trans">
                @foreach($transactions as $transaction)
                    <li>
                        <div class="trans-info">
                            <a class="trans-ctrlnumber" href="{{ url('transactions/show/'.$transaction->id) }}">
                                {!! $transaction->ctrl_number !!} -
                                {!! $transaction->item->name  !!}
                            </a>
                            {{--<div class="pull-right light">
                                <span class="issue-no-comments" title="Number of Transactions"><i class="fa fa-book"></i>{!! $transaction->children->count() !!}</span>
                            </div>--}}
                        </div>
                        <div class="trans-details">
                            <div class="trans-date inline">{!! date('M d, Y', strtotime($transaction->pawned_at)) !!}</div>
                            <div class="customer inline">by: {!! $transaction->customer->full_name !!}</div>
                            <div class="pull-right light">
                                <div class="expiry-date">Expiry Date: {!! date('M d, Y', strtotime($transaction->expired_at)) !!}</div>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
                <div class="pagination-wrap">
                    {!! $paginator !!}
                </div>
            @else
            @endif

        </div>
    </div>
</div>