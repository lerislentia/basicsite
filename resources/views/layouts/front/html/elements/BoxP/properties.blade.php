<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="background">
                image
            </label>
            <input id="IdImage" type="text" name="image" value="{{ $image or '' }}">
            <div id="ckfinder-modal" class="btn btn-primary">Browse Server</div>
        </div>

        <div class="form-group">
            <label for="header">
                header
            </label>
            <input id="IdHeader" type="text" name="header" value="{{ isset($element['array_data']['header']) ? $element['array_data']['header'] : old('header') }}">
        </div>

        <div class="form-group">
            <label for="paragraph">
                paragraph
            </label>
            <input id="IdParagraph" type="text" name="paragraph" value="{{ isset($element['array_data']['paragraph']) ? $element['array_data']['paragraph'] : old('paragraph') }}">
        </div>

        <div class="form-group">
            <label for="actionhref">
                action href
            </label>
            <input id="IdActionHref" type="text" name="actionhref" value="{{ isset($element['array_data']['actionhref']) ? $element['array_data']['actionhref'] : old('actionhref') }}">
        </div>

        <div class="form-group">
            <label for="actiontext">
                action text
            </label>
            <input id="IdActionText" type="text" name="actiontext" value="{{ isset($element['array_data']['actiontext']) ? $element['array_data']['actiontext'] : old('actiontext') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <div id="IdSaveProperties" class="btn btn-primary" >save</div>
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
                "type"      : type , 
                "entity_id" : entityid , 
                "_token"    : $('meta[name="csrf-token"]').attr('content'),
                "image"     : $('#IdImage').val(),
                "header"    : $('#IdHeader').val(),
                "paragraph" : $('#IdParagraph').val(),
                "actionhref": $('#IdActionHref').val(),
                "actiontext": $('#IdActionText').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"    : $('meta[name="csrf-token"]').attr('content'),
            "entity_id" : $('#IdEntityId').val(),
            "image"     : $('#IdImage').val(),
            "header"    : $('#IdHeader').val(),
            "paragraph" : $('#IdParagraph').val(),
            "actionhref": $('#IdActionHref').val(),
            "actiontext": $('#IdActionText').val(),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 

    

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