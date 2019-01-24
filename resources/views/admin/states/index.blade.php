@extends('layouts.back')




@section('content')



<a href="{!! route('admin.states.new') !!}"> new state</a>
        <ul>
            @foreach($states as $state)
            <li>
                    @isset($state['name_value']['lang'][$locale])
                    <a href="{!! route('admin.states.edit', ['id' => $state['id']]) !!}">{{$state['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.states.edit', ['id' => $state['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection