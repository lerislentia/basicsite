@extends('layouts.back')

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
        <option value="" {{($secti['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($entitystates as $entitystate)
                    <option value="{{$entitystate['state_id']}}" {{($secti['state_id'] == $entitystate['state_id']) ? 'selected="selected"': ''}}>
                        {{$entitystate['state']['lang'][$locale]['text'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="parent_id">
                    parent_id
                </label>
        <select name="parent_id">
        <option value="" {{($secti['parent_id'] == null ? 'selected="selected"': '')}}> - </option>
            @foreach($sections as $section)
                <option value="{{$section['id']}}" {{($section['id'] == $secti['parent_id']) ? 'selected="selected"': ''}}>
                    {{$section['name_value']['lang'][$locale]['text']}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="type">
            type
        </label>
        <select name="type_id">
        <option value="" {{($secti['type_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($types as $type)
                    <option value="{{$type['id']}}" {{($type['id'] == $secti['type_id']) ? 'selected="selected"': ''}}>
                        {{$type['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="order">
            order
                </label>
        <input type="text" name="order" value="{{ isset($section['order']) ? $section['order'] : old('order') }}">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection