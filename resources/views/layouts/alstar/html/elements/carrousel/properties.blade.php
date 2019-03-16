<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <input id="IdAddSlide" type="button" value="add slide" class="btn btn-primary">

        @isset($element['array_data'][$locale]['Slides'])
            @foreach($element['array_data'][$locale]['Slides'] as $key => $Slide)
            
            <fieldset id="fieldset_{{$key}}">

                <div class="form-group">
                    <label for="Slides[{{$key}}][LargeImage]">
                        large image
                    </label>
                    <input type="text" name="Slides[{{$key}}][LargeImage]" onclick="browseServer(this);" value="{{ isset($Slide['LargeImage']) ? $Slide['LargeImage'] : old('LargeImage') }}">
                </div>
                <div class="form-group">
                    <label for="Slides[{{$key}}][FadeInDown]">
                        fadeInDown
                    </label>
                    <input id="IdFadeInDown" type="text" name="Slides[{{$key}}][FadeInDown]" value="{{ isset($Slide['FadeInDown']) ? $Slide['FadeInDown'] : old('FadeInDown') }}">
                </div>

                <div class="form-group">
                    <label for="Slides[{{$key}}][FadeInUp]">
                        fadeInUp
                    </label>
                    <input id="IdFadeInUp" type="text" name="Slides[{{$key}}][FadeInUp]" value="{{ isset($Slide['FadeInUp']) ? $Slide['FadeInUp'] : old('FadeInUp') }}">
                </div>

                <input type="button" value="remove slide" class="btn btn-primary" onclick="remove('fieldset_{{$key}}');">

            </fieldset>
            @endforeach
        @endisset

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

if(isset($element['array_data'][$locale]['Slides'])){
    $slidesquety = count($element['array_data'][$locale]['Slides']);
}else{
    $slidesquety = 0;
}
@endphp

var slidesquety = "{{$slidesquety}}";

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

    $("#IdAddSlide").click(function(){

    slidesquety++;

    var fieldset = $("<fieldset></fieldset>");
    fieldset.attr("id","fieldset_" + slidesquety);

    var divimage      = $("<div></div>");
    divimage.attr('class', 'form-group');

    var labelimage    = $("<label></label>");
    labelimage.html("large image");
    labelimage.attr('for', 'Slides[' + (slidesquety) + '][LargeImage]');

    var inputimage    = $("<input>");

    inputimage.attr('type', 'text');
    inputimage.attr('name', 'Slides[' + (slidesquety) + '][LargeImage]');
    inputimage.attr('onclick', 'browseServer(this);');

    divimage.append(labelimage);
    divimage.append(inputimage);

    var fieldset = $("<fieldset></fieldset>");
    fieldset.attr("id","fieldset_" + slidesquety);

    var divname = $("<div></div>");
    divname.attr('class', 'form-group');

    var labelname    = $("<label></label>");
    labelname.html("fadeInDown");
    labelname.attr('for', 'Slides['+ (slidesquety) +'][FadeInDown]');

    var inputname    = $("<input>");

    inputname.attr('type', 'text');
    inputname.attr('name', 'Slides['+ (slidesquety) +'][FadeInDown]');
    divname.append(labelname);
    divname.append(inputname);


    var divcharge = $("<div></div>");
    divcharge.attr('class', 'form-group');

    var labelcharge    = $("<label></label>");
    labelcharge.html("fadeInUp");
    labelcharge.attr('for', 'Slides['+ (slidesquety) +'][FadeInUp]');

    var inputcharge    = $("<input>");

    inputcharge.attr('type', 'text');
    inputcharge.attr('name', 'Slides['+ (slidesquety) +'][FadeInUp]');
    divcharge.append(labelcharge);
    divcharge.append(inputcharge);


    var inputremove = $("<input>");
    inputremove.attr("class", "btn btn-primary");
    inputremove.attr("onclick", "remove('fieldset_"+ slidesquety + "');");
    inputremove.val("remove partner");


    fieldset.append(divimage);
    fieldset.append(divname);
    fieldset.append(divcharge);
    fieldset.append(inputremove);

    $("#IdSaveProperties").before(fieldset);
}); 
    
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
        slidesquety--;
        $('#'+item).remove();
    }


</script>