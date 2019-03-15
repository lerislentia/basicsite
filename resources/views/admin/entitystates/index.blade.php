@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
        <a href="{!! route('admin.entitystates.new') !!}"> new entitystate</a>
</div>
        <ul>
            @foreach($entitystates as $entitystate)
            <li>
                    @isset($entitystate['id'])
                    <a href="{!! route('admin.entitystates.edit', ['id' => $entitystate['id']]) !!}">{{$entitystate['entity']['name']}} - {{$entitystate['state']['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.entitystates.edit', ['id' => $entitystate['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection