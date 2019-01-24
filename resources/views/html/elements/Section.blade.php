
@php
if(isset($attrId)){
    $attr = "id='{$attrId}'";
}else{
    $attr = null;
}
@endphp
<section {{$attr}}>
    @isset($sections)
        @foreach($sections as $section)
            {!!$section!!}
        @endforeach
    @endif
</section>