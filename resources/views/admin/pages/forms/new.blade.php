@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" value="{{ isset($page['name']) ? $page['name'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($page['tags']) ? $page['tags'] : old('tags') }}">
    </div>

    <div class="form-group">
        <label for="site_id">
            site
        </label>
        <select name="site_id">
        <option value="" {{($page['site_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($sites as $site)
                    <option value="{{$site['id']}}" {{($page['site_id'] == $site['id']) ? 'selected="selected"': ''}}>
                        {{$site['name'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>

    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($page['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['id']}}" {{($page['state_id'] == $state['id']) ? 'selected="selected"': ''}}>
                        {{$state['name'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@endsection