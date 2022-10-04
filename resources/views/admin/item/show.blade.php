@extends('layouts.master')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <a href="{{ url('/admin/item') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        @if(Session::has('viewIndex'))
                            @include('admin.action')
                        @endif



                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $item->title }}</td>
                                    </tr>
                                    <tr>
                                        <th> Publisher Name </th>
                                        <td> {{ $item->publisher->publisherName }} </td>
                                    </tr>
                                    <tr>
                                        <th>  Service Category </th>
                                        <td> {{ $item->category->itemCategory }} </td>
                                    </tr>
                                    @if($item->supervisor)
                                        <tr>
                                            <th> Project Supervisor</th>
                                            <td> {{ $item->supervisor->name }} </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th> Item Standard Name </th>
                                        <td> {{ $item->itemStandardNumber->itemStandardName }} </td>
                                    </tr>
                                    <tr>
                                        <th>item Standard Number Value</th>
                                        <td>{{ $item->itemStandardNumberValue }}</td>
                                    </tr>
                                    <tr>
                                        <th>Edition</th>
                                        <td>{{ $item->edition }}</td>
                                    </tr>

                                    <tr>
                                        <th>Issue</th>
                                        <td>{{ $item->issue }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keywords</th>
                                        <td>{!! $item->keywords !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Summary</th>
                                        <td>{!! $item->summary  !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Cover Picture</th>

                                        <td>

                                            @if(!$item->imageUrl==null)
                                                <img width="150" src="{!! $item->imageUrl !!}" alt="not found!">
                                            @else
                                                <img width="150"
                                                     src="{{url('uploads/item/covers', $item->uploadImageUrl)}}"
                                                     alt="not found!">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Item File</th>
                                        <td> <a href="{{url('uploads/item/'.$item->pdfUrl)}}"><img width="100" src="{{url('assets/image/download.png')}}" alt="not found!"></a>  </td>
                                    </tr>
                                    <tr>
                                        <th>Publication Year</th>
                                        <td>{{ $item->publicationYear }}</td>
                                    </tr>
                                    <tr>
                                        <th>Place Of Publication</th>
                                        <td>{{ $item->placeOfPublication }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
