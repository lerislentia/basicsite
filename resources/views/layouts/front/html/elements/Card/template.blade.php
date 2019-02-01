

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

@endphp

<div class="col-4 col-12-medium">
	<section {!!$attr!!} {!!$attrc!!}>
		<i class="icon featured fa-cog"></i>
		<header>
			<h2>{{$header or 'Ipsum consequat'}}</h2>
		</header>
		<p>{{$paragraph or 'Nisl amet dolor sit ipsum veroeros sed blandit consequat veroeros et magna tempus.'}}</p>
	</section>
</div>

