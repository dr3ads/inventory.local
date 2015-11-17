<h1>Additional Transaction</h1>

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
    {!! Form::open(['url' => 'transactions/repawn']) !!}
    {!! Form::hidden('parent_id', $transaction->id) !!}
    {!! Form::hidden('customer_id',$transaction->customer_id); !!}
    {!! Form::hidden('item_id',$transaction->item_id); !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('customer_id', 'Customer Id') !!}
                {!! Form::select('customer',$customers,$transaction->customer_id,array('class' => 'form-control', 'readonly' => 'disabled') ) !!}
                        <!--<p class="help-block">description for future use</p>-->
            </div>
            <div class="form-group">
                {!! Form::label('pawn_amount', 'Pawn Amount') !!}
                {!! Form::number('pawn_amount', ($transaction->item->value - $transaction->pawn_amount), array('min' => 1, 'step' => 'any', 'max' => ($transaction->item->value - $transaction->pawn_amount))) !!}
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Item Details
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('item_name','Item Name') !!}
                        {!! Form::text('item_name',$transaction->item->name,array('disabled' => 'disabled')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_desc','Item Description') !!}
                        {!! Form::textarea('item_desc',$transaction->item->description, array('disabled' => 'disabled')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('item_value','Item Value') !!}
                        {!! Form::text('item_value',$transaction->item->value, array('disabled' => 'disabled')) !!}
                    </div>
                </div>
            </div>

            {!! Form::submit('Create Transaction') !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>