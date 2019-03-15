@extends('layouts.back')




@section('content')



<a href="{!! route('admin.entitytypes.new') !!}"> new entitytype</a>
        <ul>
            @foreach($entitytypes as $entitytype)
            <li>
                    @isset($entitytype['id'])
                    <a href="{!! route('admin.entitytypes.edit', ['id' => $entitytype['id']]) !!}">{{$entitytype['entity']}} - {{$entitytype['type']['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.entitytypes.edit', ['id' => $entitytype['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection