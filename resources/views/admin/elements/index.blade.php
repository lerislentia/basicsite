@extends('layouts.admin')




@section('content')



<a href="{!! route('admin.elements.new') !!}"> new element</a>
        <ul>
            @foreach($elements as $element)
            <li>
                ({{$element['order']}}) - 
                    @isset($element['name_value']['lang'][$locale])
                    <a href="{!! route('admin.elements.edit', ['id' => $element['id']]) !!}">{{$element['name_value']['lang'][$locale]['text'] or ''}} - {{$element['type']['lang'][$locale]['text'] or ''}} - {{$element['state']['lang'][$locale]['text'] or ''}} - {{$element['section']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.elements.edit', ['id' => $element['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection