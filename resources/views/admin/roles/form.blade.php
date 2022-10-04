<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('alias') ? 'has-error' : ''}}">
    {!! Form::label('alias', 'Alias', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('alias', null, ['class' => 'form-control']) !!}
        {!! $errors->first('alias', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('controller') ? 'has-error' : ''}}">
    {!! Form::label('controller', 'Actions', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <ul id="tree">
            @foreach($serviceCategory as $sc)
                <li>
                    {{ $sc->serviceCategory }}
                    <ul>
                        @foreach($sc->service as $service)
                            <li>
                                {{ Form::checkbox('services[]',$service->id, in_array($service->id, $selectedService), ['class' => 'field']) }}
                                {{ $service->action }}
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
