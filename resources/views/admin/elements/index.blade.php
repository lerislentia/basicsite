@extends('layouts.back')




@section('content')


@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<a href="{!! route('admin.elements.new') !!}"> new element</a>
        <ul>
            @foreach($elements as $element)
            <li>
                ({{$element['order']}}) - 
                    @isset($element['name_value']['lang'][$locale])
                    <a href="{!! route('admin.elements.edit', ['id' => $element['id']]) !!}">
                        <ul>
                            <li>
                                {{$element['section']['lang'][$locale]['text'] or ''}}
                                <ul>
                                    <li>
                                        {{$element['name_value']['lang'][$locale]['text'] or ''}} 
                                        -
                                        {{$element['type']['lang'][$locale]['text'] or ''}}
                                        - 
                                        {{$element['state']['lang'][$locale]['text'] or ''}}
                                        <ul>
                                            <li>
                                            <a href="{{route('admin.elements.properties.edit', ['id' => $element['id']])}}">properties</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </a>
                    
                    @else
                    <a href="{!! route('admin.elements.edit', ['id' => $element['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection