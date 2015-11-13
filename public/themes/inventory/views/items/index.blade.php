<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Items</div>
    <div class="panel-body">

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
</div>
