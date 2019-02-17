@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($page['name_value']['lang'][$locale]['text']) ? $page['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($page['tags']) ? $page['tags'] : old('tags') }}">
    </div>

    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($page['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['id']}}" {{($page['state_id'] == $state['id']) ? 'selected="selected"': ''}}>
                        {{$state['name_value']['lang'][$locale]['text'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection