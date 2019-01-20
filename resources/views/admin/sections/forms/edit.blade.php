@extends('layouts.admin')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($section['name_value']['lang'][$locale]['text']) ? $section['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
                description
                </label>
        <input type="text" name="description" value="{{ isset($section['description_value']['lang'][$locale]['text']) ? $section['description_value']['lang'][$locale]['text'] : old('description') }}">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" value="{{ isset($section['url']) ? $section['url'] : old('url') }}">
    </div>
    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($section['tags']) ? $section['tags'] : old('tags') }}">
    </div>
    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($section['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['state_id']}}" {{($state['state_id'] == $section['state_id']) ? 'selected="selected"': ''}}>
                        {{$state['state']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="type">
            type
        </label>
        <select name="type_id">
        <option value="" {{($section['type_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($types as $type)
                    <option value="{{$type['id']}}" {{($type['id'] == $section['type_id']) ? 'selected="selected"': ''}}>
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

<form action="{{route('admin.sections.delete', ['id' => $section['id']])}}" method="POST">
{{ csrf_field() }}
<input type="submit" value="delete">
</form>

@endsection