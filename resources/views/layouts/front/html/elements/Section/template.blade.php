
@php
if(isset($attrid)){
    $attr = "id='{$attrid}'";
}else{
    $attr = null;
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
<section {!!$attr!!} {!!$attrc!!}>
    @if(isset($attrheader))
        <header class="major">
            <h2>{{ isset($attrheadertitle) ? $attrheadertitle : 'My Section'}}</h2>
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