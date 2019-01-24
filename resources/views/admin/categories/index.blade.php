@extends('layouts.back')




@section('content')



<a href="{!! route('admin.categories.new') !!}"> new categorie</a>
        <ul>
            @foreach($categories as $categorie)
            <li>
                    @isset($categorie['name_value']['lang'][session('locale')])
                    <a href="{!! route('admin.categories.edit', ['id' => $categorie['id']]) !!}">{{$categorie['name_value']['lang'][session('locale')]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.categories.edit', ['id' => $categorie['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection