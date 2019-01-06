@extends('layouts.admin')




@section('content')



<a href="{!! route('admin.types.new') !!}"> new type</a>
        <ul>
            @foreach($types as $type)
            <li>
                    @isset($type['name_value']['lang'][$locale])
                    <a href="{!! route('admin.types.edit', ['id' => $type['id']]) !!}">{{$type['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.types.edit', ['id' => $type['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection