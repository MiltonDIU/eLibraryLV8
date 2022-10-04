<div class="photo-stream">
    <h2>Recent Visitor</h2>
    <ul class="list-unstyled">
        @foreach(FrontEnd::recentVisitors() as $visitor)
            @if($visitor->user->imageIcon || $visitor->user->imageBase64)
                <li>
                    @php
                        $imageUrl = $visitor->user->imageBase64==null?url('uploads/profile/icon/'.$visitor->user->imageIcon)
                        :"data:image/png;base64,".$visitor->user->imageBase64;
                    @endphp
                    <img alt="{{$visitor->user->displayName}}" src="{{ $imageUrl }}">
                </li>
            @endif
        @endforeach
    </ul>
</div>