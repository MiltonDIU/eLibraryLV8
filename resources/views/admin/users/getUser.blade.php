{{ count($users) ." out of ".$users->total() }}
<br>
<span>Query Time : </span>
{{$queryTime}}
<br>
<tr>
    <td colspan="5">{{ $users->setPath('users') }}</td>
</tr>
<table id="dataTables" class="table table-borderless">

    <thead>
    <tr>
        <th>Sl.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Download Limit</th>
        @if(Session::has('viewIndex'))
        <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration or $user->id }}</td>
            <td>{{ $user->displayName }}</td>
            <td>{{ $user->email }}</td>

            <td>
                @foreach($user->role as $role)
                    {{$role->name}},
                @endforeach
            </td>
            <td>{{ $user->download }}</td>
            <!--just call static function with id-->
            @if(Session::has('viewIndex'))


                <td>
                    {{Session::get('viewIndex.slug')}}
                    @if(Session::get('viewIndex.show')=="show")
                        <a href="{{ url('/admin/'. Session::get('controller.slug').'/'. $user->id) }}" title="View item">
                            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                        </a>
                    @endif
                    @if(Session::get('viewIndex.edit')=="edit")
                        <a href="{{ url('/admin/' . Session::get('controller.slug').'/'. $user->id . '/edit') }}" title="Edit item">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                        </a>
                    @endif
                    @if(Session::get('viewIndex.destroy')=="destroy")
                        <form method="POST" action="{{ url('/admin/' . Session::get('controller.slug').'/'. $user->id) }}"
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


            @endif
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="5">{{ $users->setPath('users') }}</td>
    </tr>
    </tfoot>

</table>
