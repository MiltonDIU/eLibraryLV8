<td>
    {{Session::get('viewIndex.slug')}}
    @if(Session::get('viewIndex.show')=="show")
        <a href="{{ url('/admin/'. Session::get('controller.slug').'/'. $item->id) }}" title="View item">
            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
        </a>
    @endif
    @if(Session::get('viewIndex.edit')=="edit")
        <a href="{{ url('/admin/' . Session::get('controller.slug').'/'. $item->id . '/edit') }}" title="Edit item">
            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
            </button>
        </a>
    @endif
    @if(Session::get('viewIndex.destroy')=="destroy")
        <form method="POST" action="{{ url('/admin/' . Session::get('controller.slug').'/'. $item->id) }}"
              accept-charset="UTF-8"
              style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete item"
                    onclick="return confirm(&quot;Confirm; delete?;&quot;)"><i
                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
            </button>
        </form>
    @endif
</td>