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

        <h3 class="page-title">Add Accessories</h3>
        <hr/>
        {!! Form::open(['route' => 'accessories.bulk-out', 'class' => 'form-horizontal', 'id' => 'bulk-add']) !!}
        <div class="form-group">
            {!! Form::label('accessory_id','Accessory *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">
                {!! Form::select('accessory_id',$accessories,'',array('class' => 'form-control chosen',
            'required' => 'required', 'data-prompt-position' => 'bottomRight:-100', 'id' => 'accessory_id', 'placeholder' => ' ', 'data-placeholder' => 'Select Accessory')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('quantity','Quantity *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('quantity',0,array('min' => 1, 'class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('quantity','Bulk Value *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::number('amount',0,array('min' => 1, 'step' => 'any','class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('description','Description', array('class' => 'col-md-2')) !!}
            <div class="col-md-10">{!! Form::textarea('description', '', array('class' => 'form-control')) !!}</div>
        </div>

        <div class="form-actions">
            {!! Form::submit('Add Quantity', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('accessories') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>