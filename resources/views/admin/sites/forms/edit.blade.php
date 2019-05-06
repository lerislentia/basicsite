@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" value="{{ isset($site['name']) ? $site['name'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="url">
        {{ __('back.url') }}
    </label>
        <input type="text" name="url" value="{{ isset($site['url']) ? $site['url'] : old('url') }}">
    </div>

    <div class="form-group">
        <label for="state">
        {{ __('back.state') }}
    </label>
        <input type="checkbox" name="state" value="1" {{ $site['state'] ==1 ? 'checked' : '' }}>
    </div>

    

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection