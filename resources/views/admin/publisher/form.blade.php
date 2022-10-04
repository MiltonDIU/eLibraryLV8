<div class="form-group {{ $errors->has('publisherName') ? 'has-error' : ''}}">
    <label for="publisherName" class="col-md-4 control-label">{{ 'Publisher Name' }}</label>
    <div class="col-md-6">
       {!! Form::text('publisherName', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('publisherName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('publisherPhone') ? 'has-error' : ''}}">
    <label for="publisherPhone" class="col-md-4 control-label">{{ 'Publisher Phone' }}</label>
    <div class="col-md-6">
        {!! Form::text('publisherPhone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('publisherPhone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('publisherEmail') ? 'has-error' : ''}}">
    <label for="publisherEmail" class="col-md-4 control-label">{{ 'Publisher Email' }}</label>
    <div class="col-md-6">
        {!! Form::email('publisherEmail', null, ['class' => 'form-control']) !!}
       {!! $errors->first('publisherEmail', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('publisherAddress') ? 'has-error' : ''}}">
    <label for="publisherAddress" class="col-md-4 control-label">{{ 'Publisher Address' }}</label>
    <div class="col-md-6">
       {!! Form::textarea('publisherAddress', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('publisherAddress', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
