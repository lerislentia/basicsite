@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($state['name_value']['lang'][$locale]['text']) ? $state['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="value">
        value
    </label>
        <input type="text" name="value" value="{{ isset($state['value']) ? $state['value'] : old('value') }}">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection