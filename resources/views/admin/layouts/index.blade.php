@extends('layouts.back')


@section('content')


<a href="{!! route('admin.layouts.new') !!}"> new layout</a>
        <ul>
            @foreach($layouts as $layout)
            <li>
                    @isset($layout['name'])
                    <a href="{!! route('admin.layouts.edit', ['id' => $layout['id']]) !!}">{{$layout['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.layouts.edit', ['id' => $layout['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection