@extends('layouts.back')

@section('content')

<a href="{!! route('admin.sectionpages.new') !!}"> new pagesection</a>
        <ul>
                
            @foreach($pagesections as $pagesection)
            <li>
                    @isset($pagesection['id'])
                    <a href="{!! route('admin.sectionpages.edit', ['id' => $pagesection['id']]) !!}">({{$pagesection['order']}}) {{$pagesection['page']['lang'][$locale]['text'] or ''}} - {{$pagesection['section']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sectionpages.edit', ['id' => $pagesection['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection