@extends('layouts.back')

@section('content')

    <h4>basic information</h4>
    <form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label>
            name
        </label>
            <div>
            {{ isset($element['name_value']['lang'][$locale]['text']) ? $element['name_value']['lang'][$locale]['text'] : old('name') }}
            </div>
        </div>

        <div class="form-group">
            <label>
                type
            </label>
            <div>{{$element['type']['name_value']['lang'][$locale]['text'] or ''}}</div>
        </div>

        <div class="form-group">
            <label>
                section
            </label>
            <div>{{$element['section']['lang'][$locale]['text'] or ''}}</div>
        </div>

        <div class="form-group">
            <label>
                state
            </label>
            <div>{{$element['state']['lang'][$locale]['text'] or ''}}</div>
        </div>

        <div class="form-group">
            <label>
                order
            </label>
            <div>
                {{ isset($element['order']) ? $element['order'] : old('order') }}
            </div>
        </div>

        <div class="form-group">
            <label>
                header
            </label>
            <input id="IdHeader" type="text" name="header" value="{{ isset($element['array_data']['header']) ? $element['array_data']['header'] : old('header') }}">
        </div>

        <div class="form-group">
            <label for="order">
                paragraph
            </label>
            <input id="IdParagraph" type="text" name="paragraph" value="{{ isset($element['array_data']['paragraph']) ? $element['array_data']['paragraph'] : old('paragraph') }}">
        </div>

        <div class="form-group">
            <label for="order">
                id (atributo)
            </label>
            <input id="IdAttrId" type="text" name="attrid" value="{{ isset($element['array_data']['attrid']) ? $element['array_data']['attrid'] : old('attrid') }}">
        </div>

        <div class="form-group">
            <label for="attrclass">
                class (atributo)
            </label>
            <input id="IdAttrClass" type="text" name="attrclass" value="{{ isset($element['array_data']['attrclass']) ? $element['array_data']['attrclass'] : old('attrclass') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="submit" value="save">
    </form>

@endsection

@section('scripts')
<script type="text/javascript">
@php
    $data = 0;
if(isset($element['data'])){
    $data = 1;
}
@endphp
$(document).ready(function () {
    var type = "{{$element['type_id']}}";
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

            } 
        );
    }
</script>
@endsection