<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <fieldset>
            <legend>Properties:</legend>

            <div class="form-group">
                <label for="HeadingLine">
                    heading-line
                </label>
                <input id="IdHeadingLine" type="text" name="HeadingLine" class="form-control" value="{{ isset($element['array_data'][$locale]['HeadingLine']) ? $element['array_data'][$locale]['HeadingLine'] : old('HeadingLine') }}">
            </div>

            <div class="form-group">
                <label for="image">
                    image fadeinup
                </label>
                <input id="IdImage" type="text" name="image" class="form-control" value="{{ isset($element['array_data'][$locale]['image']) ? $element['array_data'][$locale]['image'] : old('image') }}">
                <div id="ckfinder-modal" class="btn btn-primary">Browse Server</div>
            </div>

            <div class="form-group">
                <label for="MainTitle">
                    content main title
                </label>
                <input id="IdMainTitle" type="text" name="MainTitle" class="form-control" value="{{ isset($element['array_data'][$locale]['MainTitle']) ? $element['array_data'][$locale]['MainTitle'] : old('MainTitle') }}">
            </div>

            <div class="form-group">
                <label for="SubTitle">
                    content sub title
                </label>
                <input id="IdSubTitle" type="text" name="SubTitle" class="form-control" value="{{ isset($element['array_data'][$locale]['SubTitle']) ? $element['array_data'][$locale]['SubTitle'] : old('SubTitle') }}">
            </div>

            <textarea name="Paragraph" id="IdParagraph" rows="10" cols="80">
                {{ isset($element['array_data'][$locale]['Paragraph']) ? $element['array_data'][$locale]['Paragraph'] : old('Paragraph') }}
            </textarea>



        </fieldset>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
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

    var type = "{{$element['type_id']}}";
    var data = "{{$data}}";

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
                "type"          : type , 
                "entity_id"     : entityid , 
                "_token"        : $('meta[name="csrf-token"]').attr('content'),
                "image"         : $('#IdImage').val(),
                "HeadingLine"    : $('#IdHeadingLine').val(),
                "MainTitle"      : $('#IdMainTitle').val(),
                "SubTitle"      : $('#IdSubTitle').val(),
                "Paragraph"      : $('#IdParagraph').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"        : $('meta[name="csrf-token"]').attr('content'),
            "entity_id"     : $('#IdEntityId').val(),
            "image"         : $('#IdImage').val(),
            "HeadingLine"    : $('#IdHeadingLine').val(),
            "MainTitle"      : $('#IdMainTitle').val(),
            "SubTitle"      : $('#IdSubTitle').val(),
            "Paragraph"      : $('#IdParagraph').val(),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 

    CKEDITOR.replace( 'Paragraph' );

    var button = document.getElementById( 'ckfinder-modal' );

	button.onclick = function() {
		CKFinder.modal( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file        = evt.data.files.first();
					var output      = document.getElementById( 'IdImage' );
                    output.value    = file.getUrl();
				} );
			}
		} );
    };

</script>