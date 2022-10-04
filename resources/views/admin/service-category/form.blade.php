<div class="form-group {{ $errors->has('serviceCategory') ? 'has-error' : ''}}">
    <label for="serviceCategory" class="col-md-4 control-label">{{ 'Service Category' }}</label>
    <div class="col-md-6">
        {!! Form::text('serviceCategory', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('serviceCategory', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Image' }}</label>
    <div class="col-md-6">
       {!! Form::file('image', null, ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('serviceCategoryShort') ? 'has-error' : ''}}">
    <label for="serviceCategoryShort" class="col-md-4 control-label">{{ 'Service Category Short' }}</label>
    <div class="col-md-6">
       {!! Form::text('serviceCategoryShort', null, ['class' => 'form-control']) !!}
        {!! $errors->first('serviceCategoryShort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('isVisible') ? 'has-error' : ''}}">
    <label for="isVisible" class="col-md-4 control-label">{{ 'is Visible' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('isVisible', 1,isset($servicecategory->isVisible)?(($servicecategory->isVisible==1)?true:false):false) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('isVisible', 0, isset($servicecategory->isVisible)?(($servicecategory->isVisible==0)?true:false):true) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('lock', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('trial') ? 'has-error' : ''}}">
    <label for="lock" class="col-md-4 control-label">{{ 'Accessibility Without Authentication' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio" id="yesOn">
                {{ Form::radio('accessibilityWithoutAuthentication', 1,isset($servicecategory->accessibilityWithoutAuthentication)?(($servicecategory->accessibilityWithoutAuthentication==1)?true:false):false, ['id' => 'onYes']) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('accessibilityWithoutAuthentication', 0, isset($servicecategory->accessibilityWithoutAuthentication)?(($servicecategory->accessibilityWithoutAuthentication==0)?true:false):true, ['id' => 'onNo']) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('$servicecategory', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div id="externalUrlDiv" class="form-group {{ $errors->has('externalUrl') ? 'has-error' : ''}}">
    <label for="externalUrl" class="col-md-4 control-label">{{ 'External URL' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="externalUrl" type="text" id="externalUrl" value="{{ $servicecategory->externalUrl or ''}}" >
        {!! $errors->first('externalUrl', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
@push('style_plugins')
<style>
    #externalUrlDiv{display: none}
    .has-error{display: block!important;}
</style>
@endpush
@push('scripts_plugins')
  <script>
       $(document).ready(function(){
            $("#onYes").click(function(){
                $("#externalUrlDiv").show('slow');
            });
            $("#onNo").click(function(){
                $("#externalUrlDiv").hide('slow');
            });
        });
    </script>
@endpush

