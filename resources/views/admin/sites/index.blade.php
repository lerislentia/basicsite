@extends('layouts.back')




@section('content')


<div class="btn btn-primary">
        <a href="{!! route('admin.sites.new') !!}"> new site</a>
</div>
        <ul>
            @foreach($sites as $site)
            <li>
                    @isset($site['name'])
                    <a href="{!! route('admin.sites.edit', ['id' => $site['id']]) !!}">{{$site['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sites.edit', ['id' => $site['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection