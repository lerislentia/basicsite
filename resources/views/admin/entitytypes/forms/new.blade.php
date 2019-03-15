@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="entity_id">
            entity
        </label>
        <select name="entity_id">
        <option value="" ></option>
                @foreach($entities as $entity)
                    <option value="{{$entity['id']}}">
                        {{$entity['name']}}
                    </option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="type_id">
            type
        </label>
        <select name="type_id">
        <option value="" ></option>
                @foreach($types as $type)
                    <option value="{{$type['id']}}">
                        {{$type['name']}}
                    </option>
                @endforeach
            </select>
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection