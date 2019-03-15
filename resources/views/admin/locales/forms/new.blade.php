@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="locale">
            locale
                </label>
        <input type="text" name="id" value="{{ isset($locale['id']) ? $locale['id'] : old('id') }}">
    </div>

    <div class="form-group">
        <label for="description">
        {{ __('back.description') }}
                </label>
        <input type="text" name="description" value="{{ isset($locale['description']) ? $locale['description'] : old('description') }}">
    </div>
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection