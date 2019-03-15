

<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <label for="Mainoffice">
                    mainoffice
                </label>
                <textarea id="IdMainoffice" rows="10" cols="80" name="Mainoffice">
                {!! isset($element['array_data'][$locale]['mainoffice']) ? $element['array_data'][$locale]['mainoffice'] : old('mainoffice') !!}
                </textarea>
            </div>
            <div class="form-group">
                <label for="Call">
                    call
                </label>
                <textarea id="IdCall" rows="10" cols="80" name="Call">
                {!! isset($element['array_data'][$locale]['call']) ? $element['array_data'][$locale]['call'] : old('call') !!}
                </textarea>
            </div>
            <div class="form-group">
                <label for="Emailus">
                    emailus
                </label>
                <textarea id="IdEmailus" rows="10" cols="80" name="Emailus">
                {!! isset($element['array_data'][$locale]['emailus']) ? $element['array_data'][$locale]['emailus'] : old('emailus') !!}
                </textarea>
            </div>
        </fieldset>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <input id="IdSaveProperties" type="button" value="{{ __('back.save') }}">
</form>

<script type="text/javascript">
@php
    $data = 0;
if(isset($entity['data'])){
    $data = 1;
}

@endphp

$(document).ready(function () {

    CKEDITOR.replace( "IdMainoffice" );
    CKEDITOR.replace( "IdCall" );
    CKEDITOR.replace( "IdEmailus" );
    
    var type        = "{{$element['type_id']}}";
    var data        = "{{$data}}";

    if(data==1){
        LoadPreview(type, entityid);
    }

    $("#IdImage").change(function() {
        
        LoadPreview(type);
    });

    $("#IdHeader").change(function() {
        
        LoadPreview(type);
    });

    $("#IdParagraph").change(function() {
        
        LoadPreview(type);
    });

    $("#IdActionHref").change(function() {
        LoadPreview(type);
    });
    
    $("#IdActionText").change(function() {
        LoadPreview(type);
    });

});

function LoadPreview(type, entityid = null){
    $( "#preview" ).html("");
    $( "#preview" ).load( 
        "{{route('admin.type.preview.ajax')}}", 
            { 
                "type"                      : type , 
                "entity_id"                 : entityid , 
                "_token"                    : $('meta[name="csrf-token"]').attr('content'),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();

        var data = $('#MyForm').serialize();

        $.post("{{route('admin.type.properties.update.ajax')}}",
        data,
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 

</script>