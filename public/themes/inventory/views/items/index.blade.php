<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Items</div>
    <div class="panel-body">

    </div>

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
        <td>Item Name</td>
        <td>Brand/Model</td>
        <td>Serial Number</td>
        <td>Item Accessories</td>
        <td>Item Value</td>
        <td>Date Acquired</td>
        <td>Referrence</td>
        </thead>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->brand }}</td>
                <td>{{ $item->serial }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->value }}</td>
                <td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
                @if(isset($item->process->id))
                    <td><a href="{!! url('/transactions/show/'.$item->process->id) !!}">View Transaction Details</a></td>
                @else
                    <td>N/A</td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
