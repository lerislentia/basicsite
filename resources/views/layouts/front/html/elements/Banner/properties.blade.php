<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="order">
                background
            </label>
            <input id="IdBackground" type="text" name="background" value="{{ isset($entity['array_data']['background']) ? $entity['array_data']['background'] : old('background') }}">
        </div>

        <div class="form-group">
            <label for="order">
                header
            </label>
            <input id="IdHeader" type="text" name="header" value="{{ isset($entity['array_data']['header']) ? $entity['array_data']['header'] : old('header') }}">
        </div>

        <div class="form-group">
            <label for="order">
                paragraph
            </label>
            <input id="IdParagraph" type="text" name="paragraph" value="{{ isset($entity['array_data']['paragraph']) ? $entity['array_data']['paragraph'] : old('paragraph') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$entity['id']}}">
        <input id="IdSaveProperties" type="button" value="save">
</form>


<script type="text/javascript">
@php
    $data = 0;
if(isset($entity['data'])){
    $data = 1;
}
@endphp
$(document).ready(function () {

    var type = "{{$entity['type_id']}}";
    var data = "{{$data}}";

    if(data==1){
        LoadPreview(type);
    }

    $("#IdHeader").change(function() {
        
        LoadPreview(type);
    });

    $("#IdParagraph").change(function() {
        LoadPreview(type);
    });
    
    $("#IdAttrId").change(function() {
        LoadPreview(type);
    });

    $("#IdAttrClass").change(function() {
        LoadPreview(type);
    });

    $("#IdAttrRow").change(function() {
        LoadPreview(type);
    });

    $("#IdAttrHeader").change(function() {
        LoadPreview(type);
    });

    $("#attrheadertitle").change(function() {
        LoadPreview(type);
    });


});

function LoadPreview(type){
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


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"    : $('meta[name="csrf-token"]').attr('content'),
            "entity_id" : $('#IdEntityId').val(),
            "header"    : $('#IdHeader').val(),
            "paragraph" : $('#IdParagraph').val(),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosament");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 


</script>
