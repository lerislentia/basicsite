@extends('layouts.back')

@section('content')

    <h4>basic information</h4>
    
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">
            name
        </label>
            <div>
            {{ isset($section['name_value']['lang'][$locale]['text']) ? $section['name_value']['lang'][$locale]['text'] : old('name') }}
            </div>
        </div>

        <div class="form-group">
            <label for="type">
                type
            </label>
            <div>{{$section['type']['lang'][$locale]['text'] or ''}}</div>
        </div>

        <div class="form-group">
            <label for="state">
                state
            </label>
            <div>{{$section['state']['lang'][$locale]['text'] or ''}}</div>
        </div>

        <div class="form-group">
            <label for="order">
                order
            </label>
            <div>
                {{ isset($section['order']) ? $section['order'] : old('order') }}
            </div>
        </div>

        <form class="form-horizontal" action="" method="POST" id="MyForm">

        <div class="form-group">
            <label for="order">
                id (atributo)
            </label>
            <input id="IdAttrId" type="text" name="attrid" value="{{ isset($section['array_data']['attrid']) ? $section['array_data']['attrid'] : old('attrid') }}">
        </div>

        <div class="form-group">
            <label for="order">
                class (atributo)
            </label>
            <input id="IdAttrClass" type="text" name="attrclass" value="{{ isset($section['array_data']['attrclass']) ? $section['array_data']['attrclass'] : old('attrclass') }}">
        </div>

        <div class="form-group">
            <label for="order">
                inrow (tag)
            </label>
            <input id="IdAttrRow" type="text" name="attrrow" value="{{ isset($section['array_data']['attrrow']) ? $section['array_data']['attrrow'] : old('attrrow') }}">
        </div>

        <div class="form-group">
            <label for="attrheader">
                with header
            </label>
            <input id="IdAttrHeader" type="text" name="attrheader" value="{{ isset($section['array_data']['attrheader']) ? $section['array_data']['attrheader'] : old('attrheader') }}">
        </div>

        <div class="form-group">
            <label for="attrheadertitle">
                header title
            </label>
            <input id="IdAttrHeaderTitle" type="text" name="attrheader[attrheadertitle]" value="{{ isset($section['array_data']['attrheadertitle']) ? $section['array_data']['attrheadertitle'] : old('attrheadertitle') }}">
        </div>


        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="submit" value="save">
    </form>

@endsection

@section('scripts')
<script type="text/javascript">
@php
    $data = 0;
if(isset($section['data'])){
    $data = 1;
}
@endphp
$(document).ready(function () {
    var type = "{{$section['type_id']}}";
    var data = "{{$data}}";

    if(data==1){
        LoadTypeContent(type);
    }

    $("#IdHeader").change(function() {
        LoadTypeContent(type);
    });

    $("#IdParagraph").change(function() {
        LoadTypeContent(type);
    });
    
    $("#IdAttrId").change(function() {
        LoadTypeContent(type);
    });

    $("#IdAttrClass").change(function() {
        LoadTypeContent(type);
    });

    $("#IdAttrRow").change(function() {
        LoadTypeContent(type);
    });

    $("#IdAttrHeader").change(function() {
        LoadTypeContent(type);
    });

    $("#attrheadertitle").change(function() {
        LoadTypeContent(type);
    });


});

function LoadTypeContent(type){
    $( "#preview" ).html("");
    $( "#preview" ).load( 
        "{{route('admin.type.preview.ajax')}}", 
            { 
                "type": type , 
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "header": $('#IdHeader').val(),
                "paragraph": $('#IdParagraph').val(),
                "attrid": $('#IdAttrId').val(),
                "attrclass": $('#IdAttrClass').val(),
                "attrrow": $('#IdAttrRow').val(),
                "attrheader": $('#IdAttrHeader').val(),
                "attrheadertitle": $('#attrheadertitle').val(),
            } 
        );
    }
</script>
@endsection