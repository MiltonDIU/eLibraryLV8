<div class="form-group {{ $errors->has('departmentName') ? 'has-error' : ''}}">
    <label for="departmentName" class="col-md-4 control-label">{{ 'Department Name' }}</label>
    <div class="col-md-6">
       {!! Form::text('departmentName', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('departmentName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('deptShortName') ? 'has-error' : ''}}">
    <label for="deptShortName" class="col-md-4 control-label">{{ 'Department Short Name' }}</label>
    <div class="col-md-6">
        {!! Form::text('deptShortName', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('deptShortName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
