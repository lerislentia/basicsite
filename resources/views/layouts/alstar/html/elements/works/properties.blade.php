

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

        <input id="IdAddWork" type="button" value="add work" class="btn btn-primary">

        @isset($element['array_data'][$locale]['works'])
            @foreach($element['array_data'][$locale]['works'] as $key => $work)
            <fieldset id="fieldset_{{$key}}">
                <div class="form-group">
                    <label for="works[{{$key}}]LargeImage">
                        large image
                    </label>
                    <input id="IdLargeImage" type="text" name="works[{{$key}}][LargeImage]" onclick="browseServer(this);" value="{{ isset($work['LargeImage']) ? $work['LargeImage'] : old('LargeImage') }}">
                    
                </div>

                <div class="form-group">
                    <label for="works[{{$key}}]Title">
                        title
                    </label>
                    <input id="IdTitle" type="text" name="works[{{$key}}][Title]" value="{{ isset($work['Title']) ? $work['Title'] : old('Title') }}">
                </div>

                <div class="form-group">
                    <label for="works[{{$key}}]Description">
                        description
                    </label>
                    <textarea name="works[{{$key}}][Description]" id="IdDescription" rows="10" cols="80">
                    {{ isset($work['Description']) ? $work['Description'] : old('Description') }}
                    </textarea>
                </div>

                <input type="button" value="remove work" class="btn btn-primary" onclick="remove('fieldset_{{$key}}');">
            </fieldset>
            <script type="text/javascript">
                CKEDITOR.replace( "works[{{$key}}][Description]" );
            </script>
            @endforeach
        @endisset
        

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

if(isset($element['array_data'][$locale]['works'])){
    $workcount = count($element['array_data'][$locale]['works']);
}else{
    $workcount = 0;
}
@endphp

var workquetity = "{{$workcount}}";

$(document).ready(function () {

    
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

    $("#IdAddWork").click(function(){

        workquetity++;

        var fieldset = $("<fieldset></fieldset>");
        fieldset.attr("id","fieldset_" + workquetity);
        
        var divimage      = $("<div></div>");
        divimage.attr('class', 'form-group');
        
        var labelimage    = $("<label></label>");
        labelimage.html("large image");
        labelimage.attr('for', 'image');

        var inputimage    = $("<input>");
        inputimage.attr('id', 'IdLargeImage');
        inputimage.attr('type', 'text');
        inputimage.attr('name', 'works['+ (workquetity) +']IdLargeImage');
        inputimage.attr('onclick', 'browseServer(this);');

        divimage.append(labelimage);
        divimage.append(inputimage);


        var divtitle = $("<div></div>");
        divtitle.attr('class', 'form-group');

        var labeltitle    = $("<label></label>");
        labeltitle.html("title");
        labeltitle.attr('for', 'works['+ (workquetity) +'][Title]');

        var inputtitle    = $("<input>");
        inputtitle.attr('id', 'title');
        inputtitle.attr('type', 'text');
        inputtitle.attr('name', 'works['+ (workquetity) +'][Title]');
        divtitle.append(labeltitle);
        divtitle.append(inputtitle);

        var divdescription = $("<div></div>");
        divdescription.attr('class', 'form-group');

        var labeldescription    = $("<label></label>");
        labeldescription.html("description");
        labeldescription.attr('for', 'works['+ (workquetity) +'][Description]');

        var textareadescription    = $("<textarea></textarea>");
        textareadescription.attr('rows', '10');
        textareadescription.attr('cols', '80');
        textareadescription.attr('name', 'works['+ (workquetity) +'][Description]');
        divdescription.append(labeldescription);
        divdescription.append(textareadescription);

        var inputremove = $("<input>");
        inputremove.attr("class", "btn btn-primary");
        inputremove.attr("onclick", "remove('fieldset_"+ workquetity + "');");
        inputremove.val("remove work");

        fieldset.append(divimage);
        fieldset.append(divtitle);
        fieldset.append(divdescription);
        fieldset.append(inputremove);
        $("#IdSaveProperties").before(fieldset);

        CKEDITOR.replace( 'works['+ (workquetity) +'][Description]' );

    }); 

    // var description = CKEDITOR.replace( 'Description' );


    function browseServer(input){
        CKFinder.modal( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file        = evt.data.files.first();
					var output      = input;
                    output.value    = file.getUrl();
				} );
			}
		} );
    }

    function remove(item){
        workquetity--;
        $('#'+item).remove();
    }

    // var button = document.getElementById( 'ckfinder-modal' );

	// button.onclick = function() {
	// 	CKFinder.modal( {
	// 		chooseFiles: true,
	// 		width: 800,
	// 		height: 600,
	// 		onInit: function( finder ) {
	// 			finder.on( 'files:choose', function( evt ) {
	// 				var file        = evt.data.files.first();
	// 				var output      = document.getElementById( 'IdLargeImage' );
    //                 output.value    = file.getUrl();
	// 			} );
	// 		}
	// 	} );
    // };
    
    // var button = document.getElementById( 'ckfinder-modal-two' );

    // var button = document.getElementById( 'ckfinder-modal-tree' );

</script>