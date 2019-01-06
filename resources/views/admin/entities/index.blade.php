@extends('layouts.admin')


@section('content')


<a href="{!! route('admin.entities.new') !!}"> new entity</a>
        <ul>
            @foreach($entities as $entity)
            <li>
                    @isset($entity['name'])
                    <a href="{!! route('admin.entities.edit', ['id' => $entity['id']]) !!}">{{$entity['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.entities.edit', ['id' => $entity['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection