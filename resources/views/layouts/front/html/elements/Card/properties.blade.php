

	<section class="container">

    <header>
        properties
    </header>
    <div class="form-horizontal" id="MyForm">
        {{ csrf_field() }}
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
        <button id="IdSaveProperties" type="button" class="btn btn-default">save</button>
    </div>
</section>

<script type="text/javascript">

$("#IdSaveProperties").click(function(){

    var entity = $("#IdEntity").val();

    $.post("{{route('admin.type.properties.update.ajax')}}",
    {
        "entity_id" : entity , 
        "_token"    : $('meta[name="csrf-token"]').attr('content'),
        "header"    : $('#IdHeader').val(),
        "paragraph" : $('#IdParagraph').val(),
        "attrid"    : $('#IdAttrId').val(),
        "attrclass" : $('#IdAttrClass').val(),
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