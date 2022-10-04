<div class="form-group {{ $errors->has('authorName') ? 'has-error' : ''}}">
    <label for="authorName" class="col-md-4 control-label">{{ 'Author Name' }}</label>
    <div class="col-md-6">
        {!! Form::text('authorName', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('authorName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="col-md-4 control-label">{{ 'Author Name Small Letter' }}</label>
    <div class="col-md-6">
        {!! Form::text('slug', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary save-author" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
