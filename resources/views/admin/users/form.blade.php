<div class="form-group {{ $errors->has('displayName') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="displayName" type="text" id="displayName"
               value="{{ $user->displayName or ''}}">
        {!! $errors->first('displayName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="email" id="email" value="{{ $user->email or ''}}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('download') ? 'has-error' : ''}}">
    <label for="download" class="col-md-4 control-label">{{ 'Maximum Download Books' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="download" type="number" id="download" value="{{ $user->download or ''}}">
        {!! $errors->first('download', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Is Active ' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('status', 1,isset($user->status)?(($user->status==1)?true:false):true) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('status', 0, isset($user->status)?(($user->status==0)?true:false):false) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('isAdmin') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Is Admin ' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('isAdmin', 1,isset($user->isAdmin)?(($user->isAdmin==1)?true:false):true) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('isAdmin', 0, isset($user->isAdmin)?(($user->isAdmin==0)?true:false):false) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('isAdmin', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('verified') ? 'has-error' : ''}}">
    <label for="verified" class="col-md-4 control-label">{{ 'Is Verified User ' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('verified', 1,isset($user->verified)?(($user->verified==1)?true:false):true) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('verified', 0, isset($user->verified)?(($user->verified==0)?true:false):false) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('verified', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@php
    $role_id = isset($user->role[0]->id)?$user->role[0]->id :null;
@endphp
<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
    {!! Form::label('role_id', 'Role', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">

        <?php /*?>
          {!! Form::select('role_id', $roles, $role_id, ['placeholder' => 'please select ...', 'class' => 'form-control']) !!}
<?php */?>

        @foreach($roles as  $role)
            {!! Form::checkbox('role_id[]', $role->id, in_array($role->id, $selected_roles),['class' => 'role_id','data-idea_id'=> $role->id] ) !!} {{ $role->name }}
        @endforeach



        {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>

<div class="form-group {{ $errors->has('controller') ? 'has-error' : ''}}">
    {!! Form::label('controller', 'Actions', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <ul id="tree">
            @foreach($serviceCategory as $sc)
                <li>
                    {{ $sc->serviceCategory }}
                    <ul>
                        @foreach($sc->service as $service)
                            <li>
                                {{ Form::checkbox('services[]',$service->id, in_array($service->id, $selectedService), ['class' => 'services,field']) }}
                                {{ $service->action }}
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('.role_id').on('change', function () {
                var role_id = $(this).data("idea_id");
                // var role_idt = $(this).val();
                $('#tree').find('input[type=checkbox]:checked').prop('checked', '');
                var checkboxes = document.getElementsByName('role_id[]');
                var vals = "";
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    if (checkboxes[i].checked) {
                        vals += "," + checkboxes[i].value;
                    }
                }
                if (vals) vals = vals.substring(1);
                if (role_id > 0) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': Laravel.csrfToken
                        },
                        type: "POST",
                        url: '{{ url('/admin/users/selectedUserService') }}',
                        data: {'role_id': vals},
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            $.each(data.selectedService, function (key, val) {
                                var value = val;
                                $('input[type="checkbox"][name="services[]"][value="' + value + '"]').prop('checked', 'checked');
                                // $('input[name=services]').eq($(this).index()).prop('checked' , true);
                                //$(".role_id").prop('checked', false);
                            });
                        },
                        error: function (xhr, status, error) {
                            alert("An AJAX error occured: " + status + "\nError: " + error);
                        }
                    });
                }
            });
        });
    </script>
@endpush