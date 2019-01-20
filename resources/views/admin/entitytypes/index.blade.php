@extends('layouts.admin')




@section('content')



<a href="{!! route('admin.entitytypes.new') !!}"> new entitytype</a>
        <ul>
            @foreach($entitytypes as $entitytype)
            <li>
                    @isset($entitytype['id'])
                    <a href="{!! route('admin.entitytypes.edit', ['id' => $entitytype['id']]) !!}">{{$entitytype['entity']}} - {{$entitytype['type']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.entitytypes.edit', ['id' => $entitytype['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection