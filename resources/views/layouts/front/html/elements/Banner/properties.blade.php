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

    $("#IdHeader").change(function() {
        
        LoadPreviewData();
    });

    $("#IdParagraph").change(function() {
        LoadPreviewData();
    });
    
    $("#IdAttrId").change(function() {
        LoadPreviewData();
    });

    $("#IdAttrClass").change(function() {
        LoadPreviewData();
    });

    $("#IdAttrRow").change(function() {
        LoadPreviewData();
    });

    $("#IdAttrHeader").change(function() {
        LoadPreviewData();
    });

    $("#attrheadertitle").change(function() {
        LoadPreviewData();
    });


});

    function LoadPreviewData(){

    var type    = $("#IdType").val();

    $( "#preview" ).html("");
    $( "#preview" ).load(
        "{{route('admin.type.preview.ajax')}}", 
            { 
                "type"              : type , 
                "_token"            : $('meta[name="csrf-token"]').attr('content'),
                "header"            : $('#IdHeader').val(),
                "paragraph"         : $('#IdParagraph').val(),
                "attrid"            : $('#IdAttrId').val(),
                "attrclass"         : $('#IdAttrClass').val(),
                "attrrow"           : $('#IdAttrRow').val(),
                "attrheader"        : $('#IdAttrHeader').val(),
                "attrheadertitle"   : $('#attrheadertitle').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        var entity = $("#IdEntity").val();

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"    : $('meta[name="csrf-token"]').attr('content'),
            "entity_id" : entity,
            "header"    : $('#IdHeader').val(),
            "paragraph" : $('#IdParagraph').val(),
        },
        function(data, status){
            if(status=='success'){
                Loadpreview();
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    });


</script>
