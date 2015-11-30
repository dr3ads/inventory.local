<h1>New Transaction Receipt here:</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('', 'Transaction Details') !!}
            {{ $process->ctrl_number  }}
        </div>

        <div class="form-group">
            {!! Form::label('', 'Customer') !!}
            {{ $process->customer->full_name  }}
        </div>
        <div class="form-group">
            {!! Form::label('', 'Pawn Date') !!}
            {{ date('M d, Y', strtotime($process->pawned_at)) }}
        </div>

        <div class="form-group">
            {!! Form::label('', 'Expiry Date') !!}
            {{ date('M d, Y', strtotime($process->expired_at)) }}
        </div>

    </div>

</div>


