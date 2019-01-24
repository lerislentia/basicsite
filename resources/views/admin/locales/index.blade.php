@extends('layouts.back')




@section('content')



<a href="{!! route('admin.locales.new') !!}"> new locale</a>
        <ul>
            @foreach($locales as $locale)
            <li>
                    @isset($locale['description'])
                    <a href="{!! route('admin.locales.edit', ['id' => $locale['id']]) !!}">{{$locale['description'] or ''}}</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection