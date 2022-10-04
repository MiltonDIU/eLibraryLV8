<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="comments" class="col-md-4 control-label">{{ 'Subject' }}</label>
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'100']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('comments') ? 'has-error' : ''}}">
    <label for="comments" class="col-md-4 control-label">{{ 'Comments' }}</label>
    <div class="col-md-6">
        {!! Form::textarea('comments', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'250']) !!}
        {!! $errors->first('comments', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
