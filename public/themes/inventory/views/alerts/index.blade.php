<div class="content-wrapper">
    <div class="container-fluid">
        <div class="alerts-filter">
            <div class="controls"></div>
            <div class="status-filter">
                <h3>Alerts</h3>
                <div class="trans-details-filter">&nbsp;</div>
            </div>
        </div>

        <div class="list-alerts-holder row">
            @if(isset($alerts) && count($alerts) > 0)
                <ul class="list-alerts">
                    @foreach($alerts as $alert)
                        <li>
                            <div class="alert-info-wrap">
                                <a class="alert-info" href="#">
                                    #{!! $alert->process->ctrl_number !!}} is going to expire
                                </a>
                            </div>
                            <div class="alert-details">


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

