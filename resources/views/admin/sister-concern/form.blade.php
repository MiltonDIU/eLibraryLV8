<div class="form-group {{ $errors->has('concernName') ? 'has-error' : ''}}">
    <label for="concernName" class="col-md-4 control-label">{{ 'Concern Name' }}</label>
    <div class="col-md-6">
       {!! Form::text('concernName', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'100']) !!}
        {!! $errors->first('concernName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('emailDomain') ? 'has-error' : ''}}">
    <label for="emailDomain" class="col-md-4 control-label">{{ 'Email Domain' }}</label>
    <div class="col-md-6">
        {!! Form::text('emailDomain', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'50']) !!}
        {!! $errors->first('emailDomain', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('concernAuthorityEmail') ? 'has-error' : ''}}">
    <label for="concernAuthorityEmail" class="col-md-4 control-label">{{ 'Concern Authority Email' }}</label>
    <div class="col-md-6">
       {!! Form::text('concernAuthorityEmail', null, ['class' => 'form-control','maxlength'=>'50']) !!}
        {!! $errors->first('concernAuthorityEmail', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
