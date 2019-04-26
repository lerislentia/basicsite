

@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" class="form-control" value="{{ isset($currentproduct['name_value']['lang'][$locale]['text']) ? $currentproduct['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
        {{ __('back.description') }}
                </label>
        <input type="text" name="description" class="form-control" value="{{ isset($currentproduct['description_value']['lang'][$locale]['text']) ? $currentproduct['description_value']['lang'][$locale]['text'] : old('description') }}">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" class="form-control" value="{{ isset($currentproduct['url']) ? $currentproduct['url'] : old('url') }}">
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

@section('scripts')

<script type="text/javascript">

$(document).ready(function () {

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


if(type==''){
    return false;
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

var type    = $("#IdType").val();
var entity  = $("#IdEntity").val();

if(type==null || entity==null){
    return false;
}

$( "#properties" ).html("");

$( "#properties" ).load(
    "{{route('admin.products.properties.ajax')}}",
    {
    "entity_id" : entity ,
    "locale"    : locale ,
    "_token"    : $('meta[name="csrf-token"]').attr('content'),
    "entity_id" : entity,
    }
);
}

</script>
@endsection

@section('options')
@include('admin.partials.locales')
@endsection