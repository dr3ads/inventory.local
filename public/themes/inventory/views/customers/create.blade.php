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

        <h3 class="page-title">New Customer</h3>
        <hr />

        {!! Form::open(['route' => 'customers.store','files' => true, 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('fname', 'First Name *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('fname','',array('class' => 'form-control')) !!}</div>
                <!--<p class="help-block">description for future use</p>-->
            </div>
            <div class="form-group">
                {!! Form::label('lname', 'Last Name *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('lname','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('age', 'Age *', array('class' => 'strong col-md-3')) !!}
                <div class="col-md-9">{!! Form::number('age',18,array('class' => 'form-control', 'min' => 18)) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Address', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('address','',array('class' => 'form-control')) !!}</div>
            </div>

            <div class="form-group">
                {!! Form::label('phone', 'Home Phone', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('phone','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('mobile', 'Mobile', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('mobile','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'ID', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::file('photo', array('class' => 'btn btn-default')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('id_type', 'ID Type', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('id_type','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('id_number', 'ID No.', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('id_number','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('id_issuedby', 'Issued By', array('class' => 'col-md-3')) !!}
                <div class="col-md-9">{!! Form::text('id_issuedby','',array('class' => 'form-control')) !!}</div>
            </div>
            <div class="form-group">
                {!! Form::label('valid_until', 'Valid Until', array('class' => 'col-md-3')) !!}
                <div class="col-md-9"> {!! Form::date('valid_until',\Carbon\Carbon::now()->addDay(),array('class' => 'form-control', 'min' => \Carbon\Carbon::tomorrow())) !!}</div>
            </div>
            {!! Form::submit('Create Customer', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>
</div>