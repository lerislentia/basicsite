<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
            <legend>Slide one:</legend>
            <div class="form-group">
                <label for="backgroundone">
                    background one
                </label>
                <input id="IdImage" type="text" name="slider[1][image]" value="{{ isset($element['array_data'][$locale]['image']) ? $element['array_data']['image'] : old('image') }}">
                <div id="ckfinder-modal" class="btn btn-primary">Browse Server</div>
            </div>

            <div class="form-group">
                <label for="order">
                    fadeInDown
                </label>
                <input id="IdFadeInDown" type="text" name="slider[1][fadeInDown]" value="{{ isset($element['array_data'][$locale]['FadeInDown']) ? $element['array_data'][$locale]['FadeInDown'] : old('FadeInDown') }}">
            </div>

            <div class="form-group">
                <label for="order">
                    fadeInUp
                </label>
                <input id="IdFadeInUp" type="text" name="slider[1][fadeInUp]" value="{{ isset($element['array_data'][$locale]['FadeInUp']) ? $element['array_data'][$locale]['FadeInUp'] : old('FadeInUp') }}">
            </div>
        </fieldset>

        <fieldset>
        <legend>Slide two:</legend>
        <div class="form-group">
            <label for="backgroundtwo">
                background two
            </label>
            <input id="IdImageTwo" type="text" name="slider[2][backgroundtwo]" value="{{ isset($element['array_data'][$locale]['imageTwo']) ? $element['array_data'][$locale]['imageTwo'] : old('imageTwo') }}">
            <div id="ckfinder-modal-two" class="btn btn-primary">Browse Server</div>
        </div>
        <div class="form-group">
            <label for="order">
                fadeInDown
            </label>
            <input id="IdFadeInDownTwo" type="text" name="slider[2][fadeInDown]" value="{{ isset($element['array_data'][$locale]['FadeInDownTwo']) ? $element['array_data'][$locale]['FadeInDownTwo'] : old('FadeInDownTwo') }}">
        </div>

        <div class="form-group">
            <label for="order">
                fadeInUp
            </label>
            <input id="IdFadeInUpTwo" type="text" name="slider[2][fadeInUp]" value="{{ isset($element['array_data'][$locale]['FadeInUpTwo']) ? $element['array_data'][$locale]['FadeInUpTwo'] : old('FadeInUpTwo') }}">
        </div>
        </fieldset>
        
        <fieldset>
        <legend>Slide tree:</legend>
        <div class="form-group">
            <label for="backgroundtree">
                background tree
            </label>
            <input id="IdImageTree" type="text" name="slider[3][backgroundtree]" value="{{ isset($element['array_data'][$locale]['imageTree']) ? $element['array_data'][$locale]['imageTree'] : old('imageTree') }}">
            <div id="ckfinder-modal-tree" class="btn btn-primary">Browse Server</div>
        </div>

        <div class="form-group">
            <label for="order">
                fadeInDown
            </label>
            <input id="IdFadeInDownTree" type="text" name="slider[3][fadeInDown]" value="{{ isset($element['array_data'][$locale]['FadeInDownTree']) ? $element['array_data'][$locale]['FadeInDownTree'] : old('FadeInDownTree') }}">
        </div>

        <div class="form-group">
            <label for="order">
                fadeInUp
            </label>
            <input id="IdFadeInUpTree" type="text" name="slider[3][fadeInUp]" value="{{ isset($element['array_data'][$locale]['FadeInUpTree']) ? $element['array_data'][$locale]['FadeInUpTree'] : old('FadeInUpTree') }}">
        </div>
        </fieldset>

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
                "FadeInDown"    : $('#IdFadeInDown').val(),
                "FadeInUp"      : $('#IdFadeInUp').val(),
                "imageTwo"      : $('#IdImageTwo').val(),
                "FadeInDownTwo" : $('#IdFadeInDownTwo').val(),
                "FadeInUpTwo"   : $('#IdFadeInUpTwo').val(),
                "imageTree"     : $('#IdImageTree').val(),
                "FadeInDownTree": $('#IdFadeInDownTree').val(),
                "FadeInUpTree"  : $('#IdFadeInUpTree').val(),
                "actionhref"    : $('#IdActionHref').val(),
                "actiontext"    : $('#IdActionText').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"        : $('meta[name="csrf-token"]').attr('content'),
            "entity_id"     : $('#IdEntityId').val(),
            "image"         : $('#IdImage').val(),
            "FadeInDown"    : $('#IdFadeInDown').val(),
            "FadeInUp"      : $('#IdFadeInUp').val(),
            "imageTwo"      : $('#IdImageTwo').val(),
            "FadeInDownTwo" : $('#IdFadeInDownTwo').val(),
            "FadeInUpTwo"   : $('#IdFadeInUpTwo').val(),
            "imageTree"     : $('#IdImageTree').val(),
            "FadeInDownTree": $('#IdFadeInDownTree').val(),
            "FadeInUpTree"  : $('#IdFadeInUpTree').val(),
            "actionhref"    : $('#IdActionHref').val(),
            "actiontext"    : $('#IdActionText').val(),
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
    
    var button = document.getElementById( 'ckfinder-modal-two' );

	button.onclick = function() {
		CKFinder.modal( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file        = evt.data.files.first();
					var output      = document.getElementById( 'IdImageTwo' );
                    output.value    = file.getUrl();
				} );
			}
		} );
	};

    var button = document.getElementById( 'ckfinder-modal-tree' );

	button.onclick = function() {
		CKFinder.modal( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file        = evt.data.files.first();
					var output      = document.getElementById( 'IdImageTree' );
                    output.value    = file.getUrl();
				} );
			}
		} );
    };

</script>