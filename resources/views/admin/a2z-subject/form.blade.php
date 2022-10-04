<div class="form-group {{ $errors->has('a2zSubjectName') ? 'has-error' : ''}}">
    <label for="a2zSubjectName" class="col-md-4 control-label">{{ 'A2z Subject Name' }}</label>
    <div class="col-md-6">
         {!! Form::text('a2zSubjectName', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'50']) !!}
        {!! $errors->first('a2zSubjectName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
