@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($categorie['name_value']['lang'][$locale]['text']) ? $categorie['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
                description
                </label>
        <input type="text" name="description" value="{{ isset($categorie['description_value']['lang'][$locale]['text']) ? $categorie['description_value']['lang'][$locale]['text'] : old('description') }}">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" value="{{ isset($categorie['url']) ? $categorie['url'] : old('url') }}">
    </div>
    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($categorie['tags']) ? $categorie['tags'] : old('tags') }}">
    </div>
    <div class="form-group">
        <label for="parent_id">
                    parent_id
                </label>
        <select name="parent_id">
        <option value="" {{($categorie['parent_id'] == null ? 'selected="selected"': '')}}> - </option>
            @foreach($categories as $categori)
                <option value="{{$categori['parent_id']}}" {{($categori['parent_id'] == $categorie['parent_id']) ? 'selected="selected"': ''}}>
                    {{$categori['name_value']['lang'][$locale]['text']}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="state_id">
            state
        </label>
        <select name="state_id">
        <option value="" {{($categorie['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['state_id']}}" {{($state['id'] == $categorie['state_id']) ? 'selected="selected"': ''}}>
                        {{$state['state']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>

    


    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>


<div>
<ul>
@foreach($sections as $sectionn)
<li>
{{ $sectionn['name_value']['lang'][$locale]['text'] }}
</li>
@endforeach
</ul>
</div>
@endsection