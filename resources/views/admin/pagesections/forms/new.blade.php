@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="page_id">
            page
        </label>
        <select name="page_id">
        <option value="" ></option>
                @foreach($pages as $page)
                    <option value="{{$page['id']}}">
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
        <option value="" ></option>
                @foreach($sections as $section)
                    <option value="{{$section['id']}}">
                        {{$section['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>

    <div class="form-group">
        <label for="order">
            order
                </label>
        <input type="text" name="order" value="">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

@endsection