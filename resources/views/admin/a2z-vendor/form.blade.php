<div class="form-group {{ $errors->has('a2zVendorName') ? 'has-error' : ''}}">
    <label for="a2zVendorName" class="col-md-4 control-label">{{ 'A2zvendorname' }}</label>
    <div class="col-md-6">
             {!! Form::text('a2zVendorName', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('a2zVendorName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
