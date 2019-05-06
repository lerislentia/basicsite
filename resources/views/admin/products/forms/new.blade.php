@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="site_id">
            site
        </label>
        <select name="site_id" class="form-control">
                @foreach($sites as $site)
                    <option value="{{$site['id']}}">
                        {{$site['name'] or ''}}
                    </option>
                @endforeach
            </select>
    </div>

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" class="form-control" value="">
    </div>
    <div class="form-group">
        <label for="description">
        {{ __('back.description') }}
                </label>
        <textarea name="description" id="IdDescription" rows="10" cols="60">
        </textarea>
    </div>

    <div class="form-group">
        <label for="filename">
            large image
        </label>
        <input 
            id="IdLargeImage" 
            type="text" 
            name="filename" 
            class="form-control" 
            onclick="browseServer(this);"  
            value="">
    </div>

    <div class="form-group">
        <label for="filename">
            thumb image
        </label>
        <input 
            id="IdThumbImage" 
            type="text" 
            name="thumb" 
            class="form-control" 
            onclick="browseServer(this);"  
            value="">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

@section('scripts')

<script type="text/javascript">

$(document).ready(function () {
    CKEDITOR.replace( 'description' );
    for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();
});

</script>
@endsection

@endsection

@section('options')
<div class="col-sm-8 col-md-7 text-left">
          <br>
          <div class="container-fluid">
            <div id="preview">
            </div>
          </div>
    </div>
@endsection
