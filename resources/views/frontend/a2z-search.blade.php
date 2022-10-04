{!! Form::open(['url' => 'search/',  'files' => true]) !!}

<div class="col-md-3">

    <select id="types" class="js-example-basic-single col-md-11" name="a2z_type_id" title="Types">
        <option value="" selected disabled>Select Types</option>
        @foreach($a2z_types as $key=> $item)
            <option value="{{$item->id}}">{{$item->a2zTypeName}}({{$item->a2z_database_count}})</option>
        @endforeach
    </select>
</div>
<div class="col-md-3">

    <select id="vendors" class="js-example-basic-single col-md-11" name="a2z_vendor_id" title="Vendors">
        <option value="" selected disabled>Select Vendor</option>
        @foreach($a2z_vendors as $key=> $item)
            <option value="{{$item->id}}">{{$item->a2zVendorName}}({{$item->a2z_database_count}})</option>
        @endforeach
    </select>
</div>
<div class="col-md-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </span>
    </div>

</div>
{!! Form::close() !!}