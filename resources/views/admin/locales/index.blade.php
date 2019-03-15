@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
<a href="{!! route('admin.locales.new') !!}"> new locale</a>
</div>
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