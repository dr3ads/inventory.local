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
        <h3>New Earn</h3>
        <hr/>
        <div class="form-wrap">
            {!! Form::open(['url' => 'misc/store', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('flow', 'in') !!}
            <div class="form-group">
                {!! Form::label('type', 'Type *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::select('type',array('' => 'Select Type',
                                                    'water' => 'Water',
                                                    'electricity' => 'Electricity',
                                                    'rent' => 'Rent',
                                                    'load' => 'Mobile load',
                                                    'other' => 'Other'), '',
                                        array('class' => 'chosen form-control')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('amount', 'Amount *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::number('amount','',array('min' => 1, 'class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::textarea('description','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-actions">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>