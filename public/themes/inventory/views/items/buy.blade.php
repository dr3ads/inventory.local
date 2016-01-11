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

        <h3 class="page-title">Buy Item</h3>
        <hr/>
        {!! Form::open(['route' => 'item.buy', 'class' => 'form-horizontal', 'id' => 'buy-item']) !!}
        <div class="form-group">
            {!! Form::label('item_name','Item Name *', array('class' => 'strong col-md-2')) !!}
            <div class="col-md-10">{!! Form::text('item_name', '', array('class' => 'form-control', 'required' => 'required')) !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('item_value','Item Value *', array('class' => 'strong col-md-2')) !!}
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
        <div class="form-actions">
            {!! Form::submit('Buy Item', array('class' => 'btn btn-primary')) !!}
            <a href="{{ url('inventory') }}" class="btn btn-cancel right">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>