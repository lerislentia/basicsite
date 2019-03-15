@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
        <a href="{!! route('admin.types.new') !!}"> new type</a>
</div>
        <ul>
            @foreach($types as $type)
            <li>
                    @isset($type['name'])
                    <a href="{!! route('admin.types.edit', ['id' => $type['id']]) !!}">{{$type['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.types.edit', ['id' => $type['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection