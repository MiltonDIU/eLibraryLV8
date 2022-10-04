{{ count($items) ." out of ".$items->total() }}
<br>
<span>Query Time : </span>
{{$queryTime}}
<br>
<tr>
    <td colspan="5">{{ $items->setPath('item') }}</td>
</tr>
<table id="dataTables" class="table table-borderless">

    <thead>
    <tr>
        <th>Sl.No</th>
        <th>Title</th>
        <th>Publisher</th>
        <th>Item Standard Number</th>
        <th>Service Category</th>
        <th>Submit by</th>
        @if(Session::has('viewIndex'))
        <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}<br>
                <i class="icon-calendar font-blue"></i>
                {{ date_create($item->created_at)->format('d-m-Y')}}
            </td>
            <td>{{ $item->publisher->publisherName }}</td>
            <td>{{ $item->itemStandardNumberValue }}</td>
            <td>{{ $item->category->itemCategory }}</td>
            <td>{!! $item->user->displayName ."<br>". $item->user->diu_id !!} </td>
            <!--just call static function with id-->
            @if(Session::has('viewIndex'))
                @include('admin.action')
            @endif
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="5">{{ $items->setPath('item') }}</td>
    </tr>
    </tfoot>

</table>
