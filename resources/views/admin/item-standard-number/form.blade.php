<div class="form-group {{ $errors->has('itemStandardName') ? 'has-error' : ''}}">
    <label for="itemStandardName" class="col-md-4 control-label">{{ 'Item Standard Name' }}</label>
    <div class="col-md-6">
        {!! Form::text('itemStandardName', null, ['class' => 'form-control', 'required' => 'required']) !!}
       {!! $errors->first('itemStandardName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
