<div class="form-group {{ $errors->has('a2zTypeName') ? 'has-error' : ''}}">
    <label for="a2zTypeName" class="col-md-4 control-label">{{ 'A to Z Type Name' }}</label>
    <div class="col-md-6">
        {!! Form::text('a2zTypeName', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'50']) !!}
        {!! $errors->first('a2zTypeName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
