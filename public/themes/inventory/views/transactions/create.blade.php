<div class="content-wrapper">
    <div class="container-fluid">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 class="page-title">Create Transaction</h3>
        <hr/>
        {!! Form::open(['route' => 'transactions.store', 'class' => 'form-horizontal', 'id' => 'create-transaction']) !!}
        <div class="form-group">
            {!! Form::label('item_name','Item Name *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::text('item_name', '', array('class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('item_value','Item Value', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('item_value',0,array('min' => 1, 'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('item_brand','Item Brand/Model', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::text('item_brand', '', array('class' => 'form-control')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('item_serial','Item Serial Number', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::text('item_serial', '', array('class' => 'form-control')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('item_desc','Item Accessories', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::textarea('item_desc', '', array('class' => 'form-control')) !!}</div>
        </div>
        <div class="form-group">
            <label for="customer_id" class="strong col-md-2"><i class="fa fa-user">&nbsp;</i>Customer Id *</label>
            <div class="col-md-10"> {!! Form::select('customer_id',$customers,'',array('class' => 'form-control chosen',
                'required' => 'required', 'data-prompt-position' => 'bottomRight:-100', 'id' => 'customer_id', 'placeholder' => ' ', 'data-placeholder' => 'Chose Customer')) !!}</div>
            <!--<p class="help-block">description for future use</p>-->
        </div>
        <div class="form-group">
            {!! Form::label('pawn_amount','Pawn Amount', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('pawn_amount',0,array('min' => 1,'max' => 1, 'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-actions">
            {!! Form::submit('Submit Transaction', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('transactions') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>