<div class="main">
    <div class="container">
        <!-- BEGIN RECENT WORKS -->
        <div class="row recent-work margin-bottom-40">
            <div class="col-md-12">
                <div class="owl-carousel owl-carousel3">

                    @foreach(FrontEnd::recentUpload() as $item)
                    <div class="recent-work-item">
                       
                        <em>

                            @php
                                if (!$item->imageUrl == null) {
                                 echo  "<img class='img-responsive latest-book' alt='' src=" . $item->imageUrl . ">";
                        $fancybox = '<a href="'. $item->imageUrl .'" class="fancybox-button" title="'.$item->title.'" data-rel="fancybox-button"><i class="fa fa-search"></i></a>';
                              } else {
                                 echo  "<img class='img-responsive latest-book' alt='' src=" . url('uploads/item/covers/'. $item->uploadImageUrl) . ">";
                                  $fancybox = '<a href="'.url('uploads/item/covers/'.$item->uploadImageUrl).'" class="fancybox-button" title="'.$item->title.'" data-rel="fancybox-button"><i class="fa fa-search"></i></a>';
                              }
                            @endphp

                            <a href="{{url('service/'.$item->category->itemCategoryShort.'/'.$item->slug)}}"><i
                                        class="fa fa-link"></i></a>
                            {!! $fancybox !!}
                        </em>
                           <a class="recent-work-description" href="{{url('service/'.$item->category->itemCategoryShort.'/'.$item->slug)}}">
                            <strong>{{$item->title}}</strong>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- END RECENT WORKS -->
    </div>
</div>