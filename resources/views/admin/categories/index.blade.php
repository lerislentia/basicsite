@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
        <a href="{!! route('admin.categories.new') !!}"> new categorie</a>
</div>
        <ul>
            @foreach($categories as $categorie)
            <li>
                    @isset($categorie['name_value']['lang'][$locale])
                    <a href="{!! route('admin.categories.edit', ['id' => $categorie['id']]) !!}">{{$categorie['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.categories.edit', ['id' => $categorie['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection