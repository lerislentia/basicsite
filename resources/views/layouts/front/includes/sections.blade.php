<!-- sections -->
@foreach($sections as $key => $section)
    @if($key !== 1)
    {!!$section!!}
    @endif
@endforeach
<!-- end sections -->