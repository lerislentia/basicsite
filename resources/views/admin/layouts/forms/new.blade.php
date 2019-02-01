@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($layout['name']) ? $layout['name'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
                @foreach($states as $state)
                    <option value="{{$state['id']}}" {{($state['id'] == old('state_id')) ? 'selected="selected"': ''}}>
                        {{$state['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection