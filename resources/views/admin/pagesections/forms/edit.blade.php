@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="page_id">
            page
        </label>
        <select name="page_id">
                    <option value="" {{($currentpagesection['page_id'] == null ? 'selected="selected"': '')}}></option>
                @foreach($pages as $page)
                    <option value="{{$page['id']}}" {{($page['id'] == $currentpagesection['page_id']) ? 'selected="selected"': ''}}>
                        {{$page['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="section_id">
            section
        </label>
        <select name="section_id">
                    <option value="" {{($currentpagesection['section_id'] == null ? 'selected="selected"': '')}}></option>
                @foreach($sections as $section)
                    <option value="{{$section['id']}}" {{($section['id'] == $currentpagesection['section_id']) ? 'selected="selected"': ''}}>
                        {{$section['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="order">
            order
                </label>
        <input type="text" name="order" value="{{$currentpagesection['order'] or ''}}">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">

    
 
</form>
<form action="{{route('admin.sectionpages.delete', ['id' => $currentpagesection['id']])}}" method="POST">
    {{ csrf_field() }}
    <input type="submit" value="delete">
</form>
@endsection