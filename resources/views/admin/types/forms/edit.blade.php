@extends('layouts.admin')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($type['name_value']['lang'][$locale]['text']) ? $type['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection