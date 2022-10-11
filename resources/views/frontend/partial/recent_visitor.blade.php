<div class="photo-stream">
    <h2>Recent Visitor</h2>
    <ul class="list-unstyled">
        @foreach(FrontEnd::recentVisitors() as $visitor)
            @if($visitor->imageIcon || $visitor->imageBase64)
                <li>
                    @php
                        $imageUrl = $visitor->imageBase64==null?url('uploads/profile/icon/'.$visitor->imageIcon)
                        :"data:image/png;base64,".$visitor->imageBase64;
                    @endphp
                    <img alt="{{$visitor->displayName}}" src="{{ $imageUrl }}">
                </li>
            @endif
        @endforeach
    </ul>
</div>
