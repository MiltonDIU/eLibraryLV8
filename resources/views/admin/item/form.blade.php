
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'id'=>'title','maxlength'=>'500']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('authors_ids') ? 'has-error' : ''}}">
    <label for="authors" class="col-md-4 control-label">{{ 'Authors' }}</label>
    <div class="col-md-6">
        {!! Form::select('authors_ids[]', $authors, isset($selected_author)?$selected_author:null, ['class' => 'form-control','id'=>'author_ids', 'multiple' => 'multiple', 'onpaste'=>false]) !!}
        {!! $errors->first('authors_ids', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('edition') ? 'has-error' : ''}}">
    <label for="edition" class="col-md-4 control-label">{{ 'Edition' }}</label>
    <div class="col-md-6">
        {!! Form::text('edition', null, ['class' => 'form-control','maxlength'=>'20']) !!}
        {!! $errors->first('edition', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('publisher_id') ? 'has-error' : ''}}">
    {!! Form::label('publisher_id', 'Publisher', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">


        {!! Form::select('publisher_id',$publishers,null,['class' => 'form-control','placeholder'=>'Please Select','id'=>'publisher_id','required' => 'required']) !!}

            {!! $errors->first('publisher_id', '<p class="help-block">:message</p>') !!}


    </div>
</div>


<div class="form-group {{ $errors->has('placeOfPublication') ? 'has-error' : ''}}">
    <label for="placeOfPublication" class="col-md-4 control-label">{{ 'Place of Publication' }}</label>
    <div class="col-md-6">
        {!! Form::text('placeOfPublication', null, ['class' => 'form-control','maxlength'=>'100']) !!}
        {!! $errors->first('placeOfPublication', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('publicationYear') ? 'has-error' : ''}}">
    <label for="publicationYear" class="col-md-4 control-label">{{ 'Publication Year' }}</label>
    <div class="col-md-6">
        {!! Form::text('publicationYear', null, ['class' => 'form-control','maxlength'=>'4']) !!}
        {!! $errors->first('publicationYear', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('item_standard_number_id') ? 'has-error' : ''}}">
    <label for="item_standard_number_id" class="col-md-4 control-label">{{ 'Item Standard Number' }}</label>
    <div class="col-md-6">
        {!! Form::select('item_standard_number_id', $itemStandardNumbers, null, ['placeholder' => 'Please select ...','class' => 'form-control']) !!}
        {!! $errors->first('item_standard_number_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('itemStandardNumberValue') ? 'has-error' : ''}}">
    <label for="itemStandardNumberValue" class="col-md-4 control-label">{{ 'Item Standard Number Value' }}</label>
    <div class="col-md-6">
        {!! Form::text('itemStandardNumberValue', null, ['class' => 'form-control','maxlength'=>'20','id'=>'itemStandardNumberValue']) !!}
        {!! $errors->first('itemStandardNumberValue', '<p class="help-block" id="message">:message</p>') !!}
        <span id="message"></span>

    </div>
</div>


<div class="form-group {{ $errors->has('itemStandardNumberValue2') ? 'has-error' : ''}}">
    <label for="itemStandardNumberValue2" class="col-md-4 control-label">{{ 'Item Standard Number 2nd Value ' }}</label>
    <div class="col-md-6">
        {!! Form::text('itemStandardNumberValue2', null, ['class' => 'form-control','maxlength'=>'20','id'=>'itemStandardNumberValue2']) !!}
        {!! $errors->first('itemStandardNumberValue2', '<p class="help-block" id="message">:message</p>') !!}
        <span id="message"></span>
    </div>
</div>


<div class="form-group {{ $errors->has('departments_ids') ? 'has-error' : ''}}">
    <label for="departments" class="col-md-4 control-label">{{ 'Department' }}</label>
    <div class="col-md-6">
        {!! Form::select('departments_ids[]', $departments, isset($selected_department)?$selected_department:null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
        {!! $errors->first('departments_ids', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('summary') ? 'has-error' : ''}}">
    <label for="summary" class="col-md-4 control-label">{{ 'Summary/ Abstract' }}</label>
    <div class="col-md-6">
        {!! Form::textarea('summary', null, ['class' => 'form-control','maxlength'=>'1000']) !!}
        {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('keywords') ? 'has-error' : ''}}">
    <label for="keywords" class="col-md-4 control-label">{{ 'Keywords' }}</label>
    <div class="col-md-6">
        {!! Form::textarea('keywords', null, ['class' => 'form-control','maxlength'=>'250']) !!}
        {!! $errors->first('keywords', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="col-md-4 control-label">{{ 'Service Category' }}</label>
    <div class="col-md-6">
        {!! Form::select('category_id', $itemCategories, null, ['placeholder' => 'Please select ...', 'class' => 'form-control', 'id'=>'category_id', 'required' => 'required']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


{{--
<div id="supervisorName" class="form-group {{ $errors->has('project_supervisor') ? 'has-error' : ''}}">
    <label for="project_supervisor" class="col-md-4 control-label">{{ 'Project Supervisor' }}</label>
    <div class="col-md-6">
        {!! Form::text('project_supervisor', null, ['placeholder' => 'Project supervisor name', 'class' => 'form-control']) !!}
        {!! $errors->first('project_supervisor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
--}}

<div id="supervisorName">
    <div class="form-group {{ $errors->has('supervisor_id') ? 'has-error' : ''}}">
        <label for="supervisor_id" class="col-md-4 control-label">{{ 'Supervisor' }}</label>
        <div class="col-md-6">
            {!! Form::select('supervisor_id', $supervisors, (isset($item->itemSemesterSupervisor))?($item->itemSemesterSupervisor)?$item->itemSemesterSupervisor->supervisor_id:null:null, ['placeholder' => 'Please select ...', 'class' => 'form-control', 'id'=>'supervisor']) !!}
            {!! $errors->first('supervisor_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semester_id') ? 'has-error' : ''}}">
        <label for="semester_id" class="col-md-4 control-label">{{ 'Semester' }}</label>
        <div class="col-md-6">
            {!! Form::select('semester_id', $semesters, (isset($item->itemSemesterSupervisor))?($item->itemSemesterSupervisor)?$item->itemSemesterSupervisor->semester_id:null:null, ['placeholder' => 'Please select ...', 'class' => 'form-control', 'id'=>'semester_id']) !!}
            {!! $errors->first('semester_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>








<div class="form-group {{ $errors->has('issue') ? 'has-error' : ''}}">
    <label for="issue" class="col-md-4 control-label">{{ 'Issue' }}</label>
    <div class="col-md-6">
        {!! Form::text('issue', null, ['class' => 'form-control','maxlength'=>'50']) !!}
        {!! $errors->first('issue', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('imageUrl') ? 'has-error' : ''}}">
    <label for="imageUrl" class="col-md-4 control-label">{{ 'Cover Image URL' }}</label>
    <div class="col-md-6">
        {!! Form::text('imageUrl', null, ['class' => 'form-control','maxlength'=>'250']) !!}
        {!! $errors->first('imageUrl', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group ">
    <label for="imageUrl" class="col-md-4 control-label"></label>
    <div class="col-md-6">
        OR
    </div>
</div>

<div class="form-group {{ $errors->has('uploadImageUrl') ? 'has-error' : ''}}">
    <label for="uploadImageUrl" class="col-md-4 control-label">{{ 'Upload Cover Image' }}</label>
    <div class="col-md-6">
        {!! Form::file('uploadImageUrl', null, ['class' => 'form-control','maxlength'=>'250']) !!}
        {!! $errors->first('uploadImageUrl', '<p class="help-block">:message</p>') !!}
        <span>Max file size 1 MB and .jpg, .png only</span>
    </div>
</div>

<div class="form-group {{ $errors->has('pdfUrl') ? 'has-error' : ''}}">
    <label for="pdfUrl" class="col-md-4 control-label">{{ 'Item Upload ' }}</label>
    <div class="col-md-6">
        {!! Form::file('pdfUrl', null, ['class' => 'form-control','maxlength'=>'250']) !!}
        {!! $errors->first('pdfUrl', '<p class="help-block">:message</p>') !!}
         <span>Max file size 500 MB and docx,doc,pdf,ppt only</span>
    </div>
</div>

<div class="form-group {{ $errors->has('trial') ? 'has-error' : ''}}">
    <label for="isPublished" class="col-md-4 control-label">{{ 'Is Published' }}</label>
    <div class="col-md-6">
        <div class="mt-radio-inline">
            <label class="mt-radio">
                {{ Form::radio('isPublished', 1,isset($item->isPublished)?(($item->isPublished==1)?true:false):true) }}
                Yes
                <span></span>
            </label>
            <label class="mt-radio">
                {{ Form::radio('isPublished', 0, isset($item->isPublished)?(($item->isPublished==0)?true:false):false) }}
                No
                <span></span>
            </label>
        </div>
        {!! $errors->first('isPublished', '<p class="help-block">:message</p>') !!}
    </div>
</div>






<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText ?? 'Submit' }}">
    </div>
</div>

@push('style_plugins')
    <link href="{{url('assets/admin/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #supervisorName {
            display: none
        }
        input:required {
            content:"*";
            background: red;
            border: 2px solid gray;
        }
    </style>
@endpush
@push('scripts_plugins')
    <script src="{{ url('assets/admin/global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('#publisher_id').select2({
                tags: true,
                minimumInputLength: 2,
                tokenSeparators: [","],

            });
            // $('#author_ids').select2({
            //     tags: true,
            //      minimumInputLength:5,
            //     tokenSeparators: [","],
            // });

        });
        document.getElementById("item-form").onkeypress = function (e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        };

        $(document).ready(function () {
            var category = $('#category_id :selected').val();
            if (category == 7) {
                $('#supervisorName').show();
            } else {
                $('#supervisorName').hide('slow');
            }
        });

        $('#category_id').on('change', function () {
            if (this.value == 7) {
                $('#supervisorName').show('slow');
            } else {
                $('#supervisorName').hide('slow');
            }
        });

        $('#item_value').on('', function () {
            if (this.value == 7) {
                $('#supervisorName').show('slow');
            } else {
                $('#supervisorName').hide('slow');
            }
        });
        //title and name convert to slug value auto
        $(document).ready(function(){
            $("#itemStandardNumberValue").blur(function(e){
                var q = $(this).val().trim().toLowerCase().replace(/\s+/g, '-').replace(/\//g,'-');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken
                    },
                    type: "POST",
                    url: '{{ url('/check-item-standard-value') }}',
                    data: {'q': q},
                    cache: false,
                    success: function (response) {
                        if (response){
                            $("#message").html("This ISBN number already added in our database.").addClass
                            ('red');
                        } else{
                            $("#message").html("This ISBN number it's new, go-ahead").addClass
                            ('green').hide(7500);
                        }
                    }
                });
            });
        });
    </script>
     <!-- Script -->

     <!--ajax loading for authors name-->
    <script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
      $( "#author_ids" ).select2({
        ajax: {
          url: "{{route('author.getAuthors')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        },
        tags:true,
        minimumInputLength:2,
        tokenSeparators: [","],
        placeholder:'Type Author Name, '
      });

    });

    $(document).ready(function(){
   $('.select2-search__field').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});


    </script>
@endpush

@push('styles')
    <style>
        .red{
            color: red;
        }
        .green{
            color: green;
        }
    </style>
    @endpush
