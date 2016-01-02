<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="customer-header">
            <div class="controls">
                <a title="New Customer" id="new_customer_link" href="{{ url('customers/create') }}" class="btn btn-new pull-left"><i class="fa fa-plus"></i>
                    New Customer
                </a>
            </div>
            <div class="status-filter">
                <div class="status-filter-wrap"><h3>Customer List</h3></div>
                <div class="customer-details-filter">&nbsp;</div>
            </div>
        </div>
        <div class="list-trans-holder row">
            @if(isset($customers) && count($customers) > 0)
                <ul class="list-customers">
                    @foreach($customers as $customer)
                        <li>
                            <div class="customer-info">
                                <a class="customer-name" href="#">
                                    {!! $customer->full_name !!}
                                </a>
                                <div class="pull-right light">
                                    <span class="issue-no-comments" title="Number of Transactions"><i class="fa fa-book"></i></span>
                                </div>
                            </div>
                            <div class="customer-details">
                                <div class="customer-address inline">{!! $customer->address !!}</div>

                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="pagination-wrap">{!! $customers->render() !!}</div>
    </div>
</div>
