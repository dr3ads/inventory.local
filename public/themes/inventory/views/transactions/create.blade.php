<h1>New Transactions</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-wrap">
    {!! Form::open(['route' => 'transactions.store']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('customer_id', 'Customer Id') !!}
                {!! Form::select('customer_id',$customers,array('class' => 'form-control')) !!}
                        <!--<p class="help-block">description for future use</p>-->
            </div>
            <div class="form-group">
                {!! Form::label('pawn_amount', 'Pawn Amount') !!}
                {!! Form::number('pawn_amount',0,array('min' => 0, 'step' => 'any')) !!}
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Item Details
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('item_name','Item Name') !!}
                        {!! Form::text('item_name') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_brand','Item Brand/Model') !!}
                        {!! Form::text('item_brand') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_serial','Item Serial Number') !!}
                        {!! Form::text('item_serial') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_desc','Item Accessories') !!}
                        {!! Form::textarea('item_desc') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_value','Item Value') !!}
                        {!! Form::number('item_value',0,array('min' => 0, 'step' => 'any')) !!}
                    </div>
                </div>
            </div>

            {!! Form::submit('Create Transaction') !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>