@extends('layouts.back')




@section('content')



<a href="{!! route('admin.entitystates.new') !!}"> new entitystate</a>
        <ul>
            @foreach($entitystates as $entitystate)
            <li>
                    @isset($entitystate['id'])
                    <a href="{!! route('admin.entitystates.edit', ['id' => $entitystate['id']]) !!}">{{$entitystate['entity']}} - {{$entitystate['state']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.entitystates.edit', ['id' => $entitystate['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection