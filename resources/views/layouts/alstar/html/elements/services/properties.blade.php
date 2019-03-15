<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
        
        <div class="form-group">
                <label for="HeadingLine">
                    HeadingLine
                </label>
                <input id="IdHeadingLine" type="text" name="HeadingLine" value="{{ isset($element['array_data'][$locale]['HeadingLine']) ? $element['array_data'][$locale]['HeadingLine'] : old('HeadingLine') }}">
            </div>
        </fieldset>
        <fieldset>
            <legend>bounceInLeft one:</legend>
            <div class="form-group">
                <label for="image">
                    background one
                </label>
                <input id="IdImage" type="text" name="slider[1][image]" value="{{ isset($element['array_data'][$locale]['image']) ? $element['array_data']['image'] : old('image') }}">
                <div id="ckfinder-modal" class="btn btn-primary">Browse Server</div>
            </div>

            <div class="form-group">
                <label for="order">
                    BounceInLefOneTitle
                </label>
                <input id="IdBounceInLefOneTitle" type="text" name="slider[1][BounceInLefOneTitle]" value="{{ isset($element['array_data'][$locale]['BounceInLefOneTitle']) ? $element['array_data'][$locale]['BounceInLefOneTitle'] : old('BounceInLefOneTitle') }}">
            </div>

            <div class="form-group">
                <label for="order">
                    BounceInLefOneParagraph
                </label>
                <textarea name="BounceInLefOneParagraph" id="IdBounceInLefOneParagraph" rows="10" cols="80">
                {{ isset($element['array_data'][$locale]['BounceInLefOneParagraph']) ? $element['array_data'][$locale]['BounceInLefOneParagraph'] : old('BounceInLefOneParagraph') }}
                </textarea>
            </div>
        </fieldset>

        <fieldset>
        <legend>BounceInLef two:</legend>
        <div class="form-group">
            <label for="imageTwo">
                background two
            </label>
            <input id="IdImageTwo" type="text" name="slider[2][imageTwo]" value="{{ isset($element['array_data'][$locale]['imageTwo']) ? $element['array_data'][$locale]['imageTwo'] : old('imageTwo') }}">
            <div id="ckfinder-modal-two" class="btn btn-primary">Browse Server</div>
        </div>
        <div class="form-group">
            <label for="order">
                BounceInLefTwoTitle
            </label>
            <input id="IdBounceInLefTwoTitle" type="text" name="slider[2][BounceInLefTwoTitle]" value="{{ isset($element['array_data'][$locale]['BounceInLefTwoTitle']) ? $element['array_data'][$locale]['BounceInLefTwoTitle'] : old('BounceInLefTwoTitle') }}">
        </div>

        <div class="form-group">
            <label for="order">
                BounceInLefTwoParagraph
            </label>
            <textarea name="BounceInLefTwoParagraph" id="IdBounceInLefTwoParagraph" rows="10" cols="80">
            {{ isset($element['array_data'][$locale]['BounceInLefTwoParagraph']) ? $element['array_data'][$locale]['BounceInLefTwoParagraph'] : old('BounceInLefTwoParagraph') }}
            </textarea>

        </div>
        </fieldset>
        
        <fieldset>
        <legend>bounceInLeft tree:</legend>
        <div class="form-group">
            <label for="imageTree">
                background tree
            </label>
            <input id="IdImageTree" type="text" name="slider[3][imageTree]" value="{{ isset($element['array_data'][$locale]['imageTree']) ? $element['array_data'][$locale]['imageTree'] : old('imageTree') }}">
            <div id="ckfinder-modal-tree" class="btn btn-primary">Browse Server</div>
        </div>

        <div class="form-group">
            <label for="order">
                BounceInLefTreeTitle
            </label>
            <input id="IdBounceInLefTreeTitle" type="text" name="slider[3][BounceInLefTreeTitle]" value="{{ isset($element['array_data'][$locale]['BounceInLefTreeTitle']) ? $element['array_data'][$locale]['BounceInLefTreeTitle'] : old('BounceInLefTreeTitle') }}">
        </div>

        <div class="form-group">
            <label for="order">
                BounceInLefTreeParagraph
            </label>
            <textarea name="BounceInLefTreeParagraph" id="IdBounceInLefTreeParagraph" rows="10" cols="80">
            {{ isset($element['array_data'][$locale]['BounceInLefTreeParagraph']) ? $element['array_data'][$locale]['BounceInLefTreeParagraph'] : old('BounceInLefTreeParagraph') }}
            </textarea>
        </div>
        </fieldset>

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
                "type"                      : type , 
                "entity_id"                 : entityid , 
                "_token"                    : $('meta[name="csrf-token"]').attr('content'),
                "HeadingLine"               : $('#IdHeadingLine').val(),
                "image"                     : $('#IdImage').val(),
                "BounceInLefOneTitle"       : $('#IdBounceInLefOneTitle').val(),
                "BounceInLefOneParagraph"   : BounceInLefOneParagraph.getData(),
                "imageTwo"                  : $('#IdImageTwo').val(),
                "BounceInLefTwoTitle"       : $('#IdBounceInLefTwoTitle').val(),
                "BounceInLefTwoParagraph"   : BounceInLefTwoParagraph.getData(),
                "imageTree"                 : $('#IdImageTree').val(),
                "BounceInLefTreeTitle"      : $('#IdBounceInLefTreeTitle').val(),
                "BounceInLefTreeParagraph"  : BounceInLefTreeParagraph.getData(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"                    : $('meta[name="csrf-token"]').attr('content'),
            "entity_id"                 : $('#IdEntityId').val(),
            "HeadingLine"               : $('#IdHeadingLine').val(),
            "image"                     : $('#IdImage').val(),
            "BounceInLefOneTitle"       : $('#IdBounceInLefOneTitle').val(),
            "BounceInLefOneParagraph"   : BounceInLefOneParagraph.getData(),
            "imageTwo"                  : $('#IdImageTwo').val(),
            "BounceInLefTwoTitle"       : $('#IdBounceInLefTwoTitle').val(),
            "BounceInLefTwoParagraph"   : BounceInLefTwoParagraph.getData(),
            "imageTree"                 : $('#IdImageTree').val(),
            "BounceInLefTreeTitle"      : $('#IdBounceInLefTreeTitle').val(),
            "BounceInLefTreeParagraph"  : BounceInLefTreeParagraph.getData(),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 

    var BounceInLefOneParagraph = CKEDITOR.replace( 'BounceInLefOneParagraph' );
    var BounceInLefTwoParagraph = CKEDITOR.replace( 'BounceInLefTwoParagraph' );
    var BounceInLefTreeParagraph = CKEDITOR.replace( 'BounceInLefTreeParagraph' );

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