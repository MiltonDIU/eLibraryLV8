@if($items->count()>0)
@foreach($items as $item)
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <a href="{{url('service/'.$item->category->itemCategoryShort.'/'.$item->slug)}}">
                @if (!$item->imageUrl == null)
                    <img class='img-responsive item-cover-image' alt='' src="{{url($item->imageUrl)}}">
                @else
                    <img class='img-responsive item-cover-image' alt=''
                         src="{{url('uploads/item/covers', $item->uploadImageUrl)}}">
                @endif
            </a>
        </div>
        <div class="col-md-9 col-sm-8">
            <h3>

                <a href="{{url('service/'.$item->category->itemCategoryShort.'/'.$item->slug)}}">
                    @if(isset($q))
                        {!! str_replace($q,"<span class='highlight'>$q</span>",$item->title) !!}
                    @else
                        {!! $item->title !!}
                    @endif
                </a>

            </h3>
            <ul class="blog-info">
                <li>
                    <ul class="author-item-ul"><i class="fa fa-user"></i>
                        @foreach ($item->author as $author)
                            <li>
                                <a href="{{url('author',$author->slug)}}">{{$author->authorName}}</a>

                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><i class="fa fa-download"></i>
                    {!! FrontEnd::itemDownloadCount($item->id) !!}
                </li>
                <li><i class="fa fa-eye"></i>
                    {!! FrontEnd::itemViewCount($item->id) !!}
                </li>
            </ul>


            <p>

                @if(isset($q))
                    {!! str_replace($q,"<span class='highlight'>$q</span>",substr($item->summary, 0, 350)) !!}
                @else
                    {!! substr($item->summary, 0, 350) !!}
                @endif


            </p>

{{--                @foreach($item->department as $dept)--}}
{{--                <span style="float: left; margin-left: 20px;">--}}
{{--                {{$dept->deptShortName}},--}}
{{--                </span>--}}

{{--                    @endforeach--}}
{{--           &nbsp; &nbsp; Upload by: {{$item->user->displayName}}--}}
{{--<br>--}}



            <a class='more btn btn-cool-blues' href="{{url('service/'.$item->category->itemCategory.'/'.$item->slug)}}">Read more<i
                        class='fa fa-angle-double-right'></i></a>
            @if(!$item->pdfUrl == null)
                {!! Form::open(['url' => '/download/' . $item->id . '/' . $item->slug, 'class' => 'form-horizontal download-form', 'name' => $item->id]) !!}
                <input type='hidden' name='id' value="{{$item->id}}">
                <input type='hidden' name='slug' value="{{$item->slug}}">
                <a class="btn btn-dark-blue" href="{{url('download/'.$item->id.'/'.$item->slug)}}"><i class='fa fa-download'></i>
                    <input type='submit' class='download' value='Download'>
                </a>

                {!! Form::close() !!}
            @endif
        </div>
    </div>
    <hr class="blog-post-sep">
@endforeach
{{ $items->links() }}
@else
    <div class="row">
        There are not found any data!
    </div>
@endif

@push('style')
    <style>
        .btn-cool-blues {
            background: #2193b0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff!important;
            border: 3px solid #eee;
            line-height: 35px;
        }

        .btn-dark-blue {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff!important;
            border: 3px solid #eee;
            text-decoration: none;
            line-height: 35px;
        }
        .btn-dark-blue:focus {
            background-color:#2193b0;
        }
        .download:hover{text-decoration: none}

        .btn-cool-blues:focus {
            background-color:#4086C5;
        }
    </style>
    @endpush