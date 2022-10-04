<div class="form-group {{ $errors->has('a2z_subject_ids') ? 'has-error' : ''}}">
    <label for="placeOfPublication" class="col-md-4 control-label">{{ 'A2Z Subject' }}</label>
    <div class="col-md-6">

        {!! Form::select('a2z_subject_ids[]', $a2z_subjects, isset($selected_subjects)?$selected_subjects:null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
        {!! $errors->first('a2z_subject_ids', '<p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group {{ $errors->has('a2z_type_id') ? 'has-error' : ''}}">
    <label for="a2z_type_id" class="col-md-4 control-label">{{ 'A2Z Type' }}</label>
    <div class="col-md-6">
        {!! Form::select('a2z_type_id',$a2z_types, null, ['placeholder' => 'Please select ...','class' => 'form-control','required' => 'required']) !!}
        {!! $errors->first('a2z_type_id', '<p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group {{ $errors->has('a2z_vendor_id') ? 'has-error' : ''}}">
    <label for="a2z_vendor_id" class="col-md-4 control-label">{{ 'A2Z Vendors' }}</label>
    <div class="col-md-6">
     {!! Form::select('a2z_vendor_id',$a2z_vendors, null, ['placeholder' => 'Please select ...','class' => 'form-control','required' => 'required']) !!}
        {!! $errors->first('a2z_vendor_id', '<p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group {{ $errors->has('a2zTitle') ? 'has-error' : ''}}">
    <label for="a2zTitle" class="col-md-4 control-label">{{ 'A2Z Title' }}</label>
    <div class="col-md-6">
        {!! Form::text('a2zTitle', null, ['class' => 'form-control','required' => 'required','maxlength'=>'100']) !!}
        {!! $errors->first('a2zTitle', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('a2zDescription') ? 'has-error' : ''}}">
    <label for="a2zDescription" class="col-md-4 control-label">{{ 'A2Z Description' }}</label>
    <div class="col-md-6">
        {!! Form::text('a2zDescription', null, ['class' => 'form-control','required' => 'required','maxlength'=>'1000']) !!}
        {!! $errors->first('a2zDescription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@php
   // $isVisible = $a2zdatabase->isVisible;
@endphp

<div class="form-group {{ $errors->has('trial') ? 'has-error' : ''}}">
    <label for="lock" class="col-md-4 control-label">{{ 'Trial' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('trial', 1,isset($a2zdatabase->trial)?(($a2zdatabase->trial==1)?true:false):false) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('trial', 0, isset($a2zdatabase->trial)?(($a2zdatabase->trial==0)?true:false):true) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('lock', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('lock') ? 'has-error' : ''}}">
    <label for="lock" class="col-md-4 control-label">{{ 'Lock' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('lock', 1,isset($a2zdatabase->lock)?(($a2zdatabase->lock==1)?true:false):false) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('lock', 0, isset($a2zdatabase->lock)?(($a2zdatabase->lock==0)?true:false):true) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('lock', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('redirectLink') ? 'has-error' : ''}}">
    <label for="redirectLink" class="col-md-4 control-label">{{ 'Redirectlink' }}</label>
    <div class="col-md-6">
        {!! Form::text('redirectLink', null, ['class' => 'form-control','maxlength'=>'500']) !!}
        {!! $errors->first('redirectLink', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('isVisible') ? 'has-error' : ''}}">
    <label for="lock" class="col-md-4 control-label">{{ 'is Visible' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('isVisible',1,isset($a2zdatabase->isVisible)?(($a2zdatabase->isVisible==1)?true:false):true) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('isVisible',0,isset($a2zdatabase->isVisible)?(($a2zdatabase->isVisible==0)?true:false):false) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('lock', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--$a2zdatabase->isVisible-->
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>

@push('style_plugins')
    <link href="{{url('assets/admin/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@push('scripts_plugins')
    <script src="{{ url('assets/admin/global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush

