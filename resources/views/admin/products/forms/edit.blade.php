

@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="site_id">
            site
        </label>
        <select name="site_id" class="form-control">
        <option value="" {{($currentproduct['site_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($sites as $site)
                    <option value="{{$site['id']}}" {{($site['id'] == $currentproduct['site_id']) ? 'selected="selected"': ''}}>
                        {{$site['name']}}
                    </option>
                @endforeach
            </select>
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
            value="{{ isset($currentproduct['images'][0]['filename']) ? $currentproduct['images'][0]['filename'] : old('filename') }}">
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
            value="{{ isset($currentproduct['images'][0]['thumb']) ? $currentproduct['images'][0]['thumb'] : old('thumb') }}">
    </div>


    <input type="hidden" id="IdLocale" name="locale" value="{{$locale}}">
    <input type="hidden" id="IdEntity" value="{{$currentproduct['id']}}">
    {{ csrf_field() }}
    <input class="btn" type="submit" value="{{ __('back.save') }}">
</form>

<form action="{{route('admin.products.delete', ['id' => $currentproduct['id']])}}" method="POST">
{{ csrf_field() }}
<input class="btn" type="submit" value="delete">
</form>




@endsection

@section('options')
@include('admin.partials.locales')
@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function () {

    for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();

    LoadAll();

    $("#IdType").change(function() {
        LoadAll();
    });

    function LoadAll(){

        LoadProperties();
        Loadpreview();
        
    }


});


function Loadpreview (locale = null){

var type    = $("#IdType").val();
var entity  = $("#IdEntity").val();
if(locale == null){
    locale  = $("#IdLocale").val();
}

$( "#preview" ).html("");

$( "#preview" ).load(
            "{{route('admin.products.preview.ajax')}}",
            {
            "entity_id" : entity ,
            "locale"    : locale ,
            "_token"    : $('meta[name="csrf-token"]').attr('content')
            }
        );
}

function LoadProperties(locale = null){

var entity  = $("#IdEntity").val();

if(entity==null){
    return false;
}

$( "#properties" ).html("");

$( "#properties" ).load(
    "{{route('admin.products.properties.ajax')}}",
    {
    "entity_id" : entity ,
    "locale"    : locale ,
    "_token"    : $('meta[name="csrf-token"]').attr('content'),
    }
);
}

</script>
@endsection