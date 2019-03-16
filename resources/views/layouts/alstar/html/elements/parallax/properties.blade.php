<div class="container">
<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <fieldset>
            <legend>Properties:</legend>

            <div class="form-group">
                <label for="image">
                    image background
                </label>
                <input id="IdImage" type="text" name="image" class="form-control" value="{{ isset($element['array_data'][$locale]['image']) ? $element['array_data'][$locale]['image'] : old('image') }}">
                <div id="ckfinder-modal" class="btn btn-primary">Browse Server</div>
            </div>

            <div class="form-group">
                <label for="HeadingLine">
                    BounceInDown
                </label>
                <input id="IdBounceInDown" type="text" name="BounceInDown" class="form-control" value="{{ isset($element['array_data'][$locale]['BounceInDown']) ? $element['array_data'][$locale]['BounceInDown'] : old('BounceInDown') }}">
            </div>

            <div class="form-group">
                <label for="MainTitle">
                    BounceInUp
                </label>
                <input id="IdBounceInUp" type="text" name="BounceInUp" class="form-control" value="{{ isset($element['array_data'][$locale]['BounceInUp']) ? $element['array_data'][$locale]['BounceInUp'] : old('BounceInUp') }}">
            </div>

        </fieldset>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <input id="IdSaveProperties" type="button" value="{{ __('back.save') }}">
</form>
</div>
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

    $("#IdBounceInDown").change(function() {
        
        LoadPreview(type);
    });

    $("#IdBounceInUp").change(function() {
        
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
                "BounceInDown"    : $('#IdBounceInDown').val(),
                "BounceInUp"      : $('#IdBounceInUp').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"        : $('meta[name="csrf-token"]').attr('content'),
            "entity_id"     : $('#IdEntityId').val(),
            "image"         : $('#IdImage').val(),
            "BounceInDown"    : $('#IdBounceInDown').val(),
            "BounceInUp"      : $('#IdBounceInUp').val(),
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