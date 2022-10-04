<style>
    table.greyGridTable {
        border: 2px solid #FFFFFF;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }
    table.greyGridTable td, table.greyGridTable th {
        border: 1px solid #FFFFFF;
        padding: 3px 4px;
    }
    table.greyGridTable  tbody td {
        font-size: 13px;
    }
    table.greyGridTable tbody tr{
        border: 2px solid #ebe8f0;
    }
    .header{background: #ebe8f0; font-weight: bold;}

    table.greyGridTable thead {
        background: #FFFFFF;
        border-bottom: 4px solid #333333;
    }
    table.greyGridTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #333333;
        text-align: center;
        border-left: 2px solid #333333;
    }
    table.greyGridTable thead th:first-child {
        border-left: none;
    }

    table.greyGridTable tfoot {
        font-size: 14px;
        font-weight: bold;
        color: #333333;
        border-top: 4px solid #333333;
    }
    table.greyGridTable tfoot td {
        font-size: 14px;
    }

    .center {
        width: 100%;
        padding: 10px;
        text-align: center;
    }
    table.greyGridTable tbody tr {
        border: 1px solid #000000;
        padding: 3px 4px;

    }

</style>
<div class="center">
    <img src="http://203.190.10.202/member/assets/image/logo.png" alt="logo" align="center"><br>
    <h3>Daffodil International University</h3>
    <span>Upload Statistics Report for {{$dateSelect}}</span>
    <span class="date" style="padding-right: 15px; position: absolute; right: 0; top: 0">Date: {{date('d-m-Y')}}</span>
</div>
<table class="greyGridTable">
    <tr class="header">
        <th>Sl.No</th>
        <th>Title</th>
        <th>Author</th>
        <th>Edition</th>
        <th>Service Name</th>
        <th>Library Person</th>
    </tr>
    <tbody>
    @php
        $i=1;
        $j=1;
    @endphp
    @foreach($items as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->title }}</td>
            <td>
                @foreach($item->author as $author)
                    {{$j++}}
                    {{$author->authorName.(sizeof($item->author)>=$j?",":'')}}
                @endforeach
                @php
                    $j=1;
                @endphp
            </td>
            <td>{{ $item->edition }}</td>
            <td>{{ $item->category->itemCategory }}</td>
            <td>{{ $item->user->displayName }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
