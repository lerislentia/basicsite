@php


@endphp
<!-- Nav -->
<nav>
    <ul>
            @foreach($categories as $categorie)
            <li>
                <a href="{{$categorie['url']}}">{{$categorie['name_value']['lang']['es']['text']}}</a>
                @if(count($categorie['childs'])>0)
                    
                    <ul>
                    @foreach($categorie['childs'] as $child)
                        <a href="{{$child['url']}}">{{$child['name_value']['lang']['es']['text']}}</a>
                    @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
    </ul>
</nav>