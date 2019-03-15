@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
        <a href="{!! route('admin.states.new') !!}"> new state</a>
</div>
        <ul>
            @foreach($states as $state)
            <li>
                    @isset($state['name'])
                    <a href="{!! route('admin.states.edit', ['id' => $state['id']]) !!}">{{$state['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.states.edit', ['id' => $state['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection