@extends('layouts.admin')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($secti['name_value']['lang'][$locale]['text']) ? $secti['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
                description
                </label>
        <input type="text" name="description" value="{{ isset($secti['description_value']['lang'][$locale]['text']) ? $secti['description_value']['lang'][$locale]['text'] : old('description') }}">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" value="{{ isset($secti['url']) ? $secti['url'] : old('url') }}">
    </div>
    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($secti['tags']) ? $secti['tags'] : old('tags') }}">
    </div>
    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($secti['state'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['id']}}" {{($secti['state'] == $state['id']) ? 'selected="selected"': ''}}>
                        {{$state['state']['lang'][$locale]['text'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>



    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection