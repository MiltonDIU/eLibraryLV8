@if (count($databases) > 0)
    @foreach($databases as $database)
        <div class="search-result-item">
            <div id="load" style="position: relative;"></div>
            <h4><a target="_blank" href="{{$database->redirectLink}}">{{$database->a2zTitle}}</a></h4>
            <p>{{$database->a2zDescription}}</p>
            <a target="_blank" class="search-link"></a>
        </div>
    @endforeach

    {{ $databases->links() }}
@else
    <div class="row">
        There are not found any data!
    </div>
@endif
<?php /*
@if($databases->count()>0)
    <div class="content-page">
        @foreach($databases as $database)
            <div class="search-result-item">
                <h4><a target="_blank" href="{{$database->redirectLink}}">{{$database->a2zTitle}}</a></h4>
                <p>{{$database->a2zDescription}}</p>
                <a target="_blank" class="search-link"></a>
            </div>
        @endforeach
        {{ $databases->links() }}
    </div>

@else
    <div class="content-page">
    <div class="row">
        There are not found any data!
    </div>
    </div>
@endif

