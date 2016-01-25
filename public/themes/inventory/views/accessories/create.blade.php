<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="page-title">New Accessory</h3>
        <hr/>
        {!! Form::open(['route' => 'accessories.new', 'class' => 'form-horizontal', 'id' => 'create-accessory']) !!}
        <div class="form-group">
            {!! Form::label('name','Accessory Name', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::text('name', '', array('class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('quantity','Quantity *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('quantity',0,array('min' => 1,  'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('unit_price','Unit Price *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('unit_price',0,array('min' => 1,'step' => 'any', 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('description','Description', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::textarea('description', '', array('class' => 'form-control')) !!}</div>
        </div>

        <div class="form-actions">
            {!! Form::submit('Create Accessory', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('accessories') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>