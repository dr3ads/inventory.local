<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Customers</div>
    <div class="panel-body">
        <a href="{!! url('customers/create') !!}" >New Customer</a>
    </div>

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Age</td>
            <td>Home Phone</td>
            <td>Mobile</td>
        </thead>
        @foreach($customers as $customer)
            <tr>
                <td>{!! $customer->fname !!}</td>
                <td>{!! $customer->lname !!}</td>
                <td>{!! $customer->age !!}</td>
                <td>{!! $customer->phone !!}</td>
                <td>{!! $customer->mobile !!}</td>
            </tr>
        @endforeach
    </table>
    {!! $customers->render() !!}
</div>
