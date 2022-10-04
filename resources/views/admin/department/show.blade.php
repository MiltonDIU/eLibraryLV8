@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ url('/admin/department') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    @if(Session::has('viewIndex'))
                        @include('admin.action')
                    @endif
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th> DepartmentName</th>
                                <td> {{ $item->departmentName }} </td>
                            </tr>
                            <tr>
                                <th> DeptShortName</th>
                                <td> {{ $item->deptShortName }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable books-table">
                        <thead>
                        <tr>
                            <th width="100">
                                sl.no
                            </th>
                            <th>
                                Title
                            </th>
                            <th>Edition</th>
                            <th>Author's Name</th>
                            <th>Category</th>
                            <th>Departments</th>

                            {{--                                <th>Category</th>--}}
<th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.datatables')
@push('datatables')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                searching:false,
                aaSorting: [],
                ajax: "{{ route('department-book-list',['id'=>$item->id]) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { "data": "title",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a target='_blank' href='"+oData.url+"'>"+oData.title+"</a>");
                        }
                    },
                    { data: 'edition', name: 'edition' },
                    { data: 'author', name: 'author' },
                    { data: 'category', name: 'category' },
                    { data: 'department', name: 'department' },
                    { "data": "edit",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a target='_blank' href='"+oData.edit+"'>Edit</a>");
                        }
                    },
                ],

                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                aLengthMenu: [
                    [20, 50, 100, 200, 500, 1000, -1],
                    [20, 50, 100, 200, 500, 1000, "All"]
                ],
                pageLength: 50,
            };
            let table = $('.books-table').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>


{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            var table = $('.books-table').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                aLengthMenu: [--}}
{{--                    [20, 50, 100, 200, 500, 1000, -1],--}}
{{--                    [20, 50, 100, 200, 500, 1000, "All"]--}}
{{--                ],--}}
{{--                ajax: "{{ route('department-book-list',['id'=>$item->id]) }}",--}}
{{--                columns: [--}}
{{--                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
{{--                    { "data": "title",--}}
{{--                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {--}}
{{--                            $(nTd).html("<a target='_blank' href='"+oData.data.url+"'>"+oData.title+"</a>");--}}
{{--                        }--}}
{{--                    },--}}
{{--                ]--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}




@endpush
