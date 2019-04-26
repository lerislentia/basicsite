@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" value="">
    </div>
    <div class="form-group">
        <label for="description">
        {{ __('back.description') }}
                </label>
        <input type="text" name="description" value="">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" value="">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection

