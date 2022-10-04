<!DOCTYPE html>
<html>
  <head>
    <title>Loading data remotely in Select2 – Laravel</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('assets/admin/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="https://archives.daffodilvarsity.edu.bd/assets/admin/global/plugins/jquery.min.js" type="text/javascript"></script>
    <!-- Script -->
      <script src="{{ url('assets/admin/global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
  </head>
  <body>

    <!-- For defining autocomplete -->
    <select id='selUser' style='width: 200px;'  multiple="multiple">
      <option value='0'>-- Select user --</option>
    </select>

    <!-- Script -->
    <script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
      $( "#selUser" ).select2({
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
      });

    });
    

    
    </script>
  </body>
</html>