@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" value="{{ isset($type['name']) ? $type['name'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="definition">
        definition
    </label>
        <input type="text" name="definition" value="{{ isset($type['definition']) ? $type['definition'] : old('definition') }}">
    </div>

      <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection