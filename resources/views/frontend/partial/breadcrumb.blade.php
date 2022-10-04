@php
    $path = request()->path();
    $pathArray = explode('/', $path);
    $urlPath ="";
    $numItems = count($pathArray);
    $i = 0;
@endphp
<ul class="breadcrumb margin-bottom-40 ">
    <li><a href="{{url('/')}}">home</a></li>
    @foreach($pathArray as $key=>$item)
        @php
            $urlPath .="/$item";
        $item=ucwords(str_replace('-',' ',$item));
        @endphp
        @if(++$i===$numItems)
            @php
                echo "<li class='active'>$item</li>";
            @endphp
        @else
            @php
                echo "<li><a href=".url($urlPath).">$item</a></li>";
            @endphp
        @endif

    @endforeach
</ul>