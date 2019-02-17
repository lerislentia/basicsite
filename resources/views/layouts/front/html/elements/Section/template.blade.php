
@php
if(isset($attrid)){
    $attr = "id='{$attrid}'";
}else{
    $attr = null;
}

if(isset($attrname)){
    $attrname = "name='{$attrname}'";
}else{
    $attrname = null;
}

if(isset($attrclass)){
    $attrc = "class='{$attrclass}'";
}else{
    $attrc = null;
}

if(isset($attrrow)){
    $attrrow = "class='{$attrrow}'";
}else{
    $attrrow = null;
}


@endphp
<section {!!$attr!!} {!!$attrc!!} {!!$attrname!!}>
    @if(isset($attrheader) && $attrheader=='true')
        <header class="major">
            <h2>{{ isset($attrheadertitle) ? $attrheadertitle : ''}}</h2>
        </header>
    @endif
    @isset($childs)
        @if(isset($attrrow))
        <div class="row">
        @endif
        @foreach($childs as $child)
            {!!$child!!}
        @endforeach
        @if(isset($attrrow))
        </div>
        @endif
    @endif
</section>