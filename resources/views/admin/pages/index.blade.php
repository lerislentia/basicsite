@extends('layouts.back')

@section('content')

<a href="{!! route('admin.pages.new') !!}"> new page</a>
        <ul>
            @foreach($pages as $page)
            <li>
                
                    @isset($page['name_value']['lang'][$locale])
                    <a href="{!! route('admin.pages.edit', ['id' => $page['id']]) !!}">{{$page['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.pages.edit', ['id' => $page['id']]) !!}">unstranslated</a>
                    @endisset

             </li>
            @endforeach
        </ul>
@endsection