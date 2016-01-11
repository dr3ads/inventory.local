<div class="content-wrapper">
    <div class="container-fluid">
        <div class="alerts-filter">
            <div class="controls">&nbsp;</div>
            <div class="alerts-filter">
                <div class="status-filter-wrap"><h3>Alerts</h3></div>
                <div class="trans-details-filter">&nbsp;</div>
            </div>
        </div>

        <div class="list-alerts-holder row">
            @if(isset($alerts) && count($alerts) > 0)
                <ul class="list-alerts">
                    @foreach($alerts as $alert)
                        <li>
                            <div class="alert-info-wrap">
                                <a class="alert-info" href="{{ url('transactions/show/'.$alert->process->id) }}">
                                    #{!! $alert->process->ctrl_number !!} is going to expire
                                </a>
                            </div>
                            <div class="alert-details">
                                @if(Carbon::now()->diffInDays($alert->process->expired_at ) == 0) will expire today
                                @elseif( Carbon::now()->diffInDays($alert->process->expired_at ) == 1 )  expires tomorrow
                                @else( Carbon::now()->diffInDays($alert->process->expired_at ) == 1 )  {!! Carbon::now()->diffInDays($alert->process->expired_at ) !!} days from now
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination-wrap">
                    {!! $alerts->render() !!}
                </div>
            @endif

        </div>
    </div>
</div>

