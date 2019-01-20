@extends('layouts.admin')




@section('content')



<a href="{!! route('admin.sections.new') !!}"> new section</a>
        <ul>
            @foreach($sections as $section)
            <li>
                ({{$section['order']}}) - 
                    @isset($section['name_value']['lang'][$locale])
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">{{$section['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection