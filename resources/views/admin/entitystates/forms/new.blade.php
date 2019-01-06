@extends('layouts.admin')

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
        <label for="state_id">
            state
        </label>
        <select name="state_id">
        <option value="" ></option>
                @foreach($states as $state)
                    <option value="{{$state['id']}}">
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