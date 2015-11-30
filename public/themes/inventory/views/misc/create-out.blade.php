<h1>Miscellaneous Cash Out</h1>

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
    {!! Form::open(['url' => 'misc/store']) !!}
    {!! Form::hidden('flow', 'out') !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('type', 'Type') !!}
                {!! Form::select('type',array('' => 'Select Type','water' => 'Water', 'electricity' => 'Electricity', 'rent' => 'Rent', 'load' => 'Mobile load', 'other' => 'Other')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('amount', 'Amount') !!}
                {!! Form::number('amount','',array('min' => 1)) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description') !!}
            </div>

            {!! Form::submit('Submit') !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>