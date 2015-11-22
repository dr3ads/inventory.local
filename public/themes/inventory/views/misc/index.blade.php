<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Items</div>
    <div class="panel-body">

    </div>

    <!-- Table -->
    <table class="table table-hover table-striped">
        <thead>
        <td>Type</td>
        <td>Flow</td>
        <td>Description</td>
        <td>Date</td>
        </thead>
        @foreach($miscs as $misc)
            <tr>
                <td>{!! $misc->type !!}</td>
                <td>{!! $misc->flow !!}</td>
                <td>{!! $misc->description !!}</td>
                <td>{!! $misc->created_at !!}</td>
            </tr>
        @endforeach
    </table>
</div>
