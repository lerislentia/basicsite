@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="description">
                description
                </label>
        <input type="text" name="description" value="{{ isset($locale['description']) ? $locale['description'] : old('description') }}">
    </div>
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection