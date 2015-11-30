<h1>New Customer</h1>

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
    {!! Form::open(['route' => 'customers.store','files' => true]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('fname', 'First Name') !!}
                    {!! Form::text('fname','',array('class' => 'form-control')) !!}
                    <!--<p class="help-block">description for future use</p>-->
                </div>
                <div class="form-group">
                    {!! Form::label('lname', 'Last Name') !!}
                    {!! Form::text('lname','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('age', 'Age') !!}
                    {!! Form::number('age',18,array('class' => 'form-control', 'min' => 18)) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address') !!}
                    {!! Form::text('address','',array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Home Phone') !!}
                    {!! Form::text('phone','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mobile', 'Mobile') !!}
                    {!! Form::text('mobile','',array('class' => 'form-control')) !!}
                </div>
                {!! Form::submit('Create Customer') !!}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('photo', 'ID') !!}
                    {!! Form::file('photo','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_type', 'ID Type') !!}
                    {!! Form::text('id_type','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_number', 'ID No.') !!}
                    {!! Form::text('id_number','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('id_issuedby', 'Issued By') !!}
                    {!! Form::text('id_issuedby','',array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('valid_until', 'Valid Until') !!}
                    {!! Form::date('valid_until',\Carbon\Carbon::now()->addDay(),array('class' => 'form-control', 'min' => \Carbon\Carbon::tomorrow())) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>