<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
        
        <div class="form-group">
                <label for="HeadingLine">
                    HeadingLine
                </label>
                <input id="IdHeadingLine" type="text" name="HeadingLine" class="form-control" value="{{ isset($element['array_data'][$locale]['HeadingLine']) ? $element['array_data'][$locale]['HeadingLine'] : old('HeadingLine') }}">
            </div>
        </fieldset>

        <input id="IdAddService" type="button" value="add service" class="btn btn-primary">
        @isset($element['array_data'][$locale]['Services'])
            @foreach($element['array_data'][$locale]['Services'] as $key => $Service)

        <fieldset id="fieldset_{{$key}}">
            <legend>bounceInLeft one:</legend>
            <div class="form-group">
                <label for="Services[{{$key}}][LargeImage]">
                    background one
                </label>
                <input id="IdLargeImage" type="text" name="Services[{{$key}}][LargeImage]" onclick="browseServer(this);" class="form-control" value="{{ isset($Service['LargeImage']) ? $Service['LargeImage'] : old('LargeImage') }}">
            </div>

            <div class="form-group">
                <label for="Services[{{$key}}][BounceInLefOneTitle]">
                    BounceInLefOneTitle
                </label>
                <input id="IdBounceInLefOneTitle" type="text" name="Services[{{$key}}][BounceInLefOneTitle]" class="form-control" value="{{ isset($Service['BounceInLefOneTitle']) ? $Service['BounceInLefOneTitle'] : old('BounceInLefOneTitle') }}">
            </div>

            <div class="form-group">
                <label for="order">
                    BounceInLefOneParagraph
                </label>
                <textarea name="Services[{{$key}}][BounceInLefOneParagraph]" rows="10" cols="80">
                {!! isset($Service['BounceInLefOneParagraph']) ? $Service['BounceInLefOneParagraph'] : old('BounceInLefOneParagraph') !!}
                </textarea>
            </div>
        </fieldset>

        <input type="button" value="remove Service" class="btn btn-primary" onclick="remove('fieldset_{{$key}}');">

        <script type="text/javascript">
            CKEDITOR.replace( "Services[{{$key}}][BounceInLefOneParagraph]" );
        </script>
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

if(isset($element['array_data'][$locale]['Services'])){
    $servicequety = count($element['array_data'][$locale]['Services']);
}else{
    $servicequety = 0;
}

@endphp

var servicequety = "{{$servicequety}}";

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

    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();

    var data = $('#MyForm').serialize();
    $( "#preview" ).load( 
        "{{route('admin.type.preview.ajax')}}", 
        data
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

    $("#IdAddService").click(function(){

        servicequety++;

        var fieldset = $("<fieldset></fieldset>");
        fieldset.attr("id","fieldset_" + servicequety);

        var divimage      = $("<div></div>");
        divimage.attr('class', 'form-group');

        var labelimage    = $("<label></label>");
        labelimage.html("large image");
        labelimage.attr('for', 'Services[' + (servicequety) + ']LargeImage');

        var inputimage    = $("<input>");

        inputimage.attr('type', 'text');
        inputimage.attr('class', 'form-control');
        inputimage.attr('name', 'Services[' + (servicequety) + ']LargeImage');
        inputimage.attr('onclick', 'browseServer(this);');

        divimage.append(labelimage);
        divimage.append(inputimage);

        var fieldset = $("<fieldset></fieldset>");
        fieldset.attr("id","fieldset_" + servicequety);

        var divname = $("<div></div>");
        divname.attr('class', 'form-group');

        var labelname    = $("<label></label>");
        labelname.html("BounceInLefOneTitle");
        labelname.attr('for', 'Services['+ (servicequety) +'][BounceInLefOneTitle]');

        var inputname    = $("<input>");

        inputname.attr('type', 'text');
        inputname.attr('class', 'form-control');
        inputname.attr('name', 'Services['+ (servicequety) +'][BounceInLefOneTitle]');
        divname.append(labelname);
        divname.append(inputname);


        var divcharge = $("<div></div>");
        divcharge.attr('class', 'form-group');

        var labelcharge    = $("<label></label>");
        labelcharge.html("BounceInLefOneParagraph");
        labelcharge.attr('for', 'Services['+ (servicequety) +'][BounceInLefOneParagraph]');

        var inputcharge    = $("<textarea>");

        
        inputcharge.attr('name', 'Services['+ (servicequety) +'][BounceInLefOneParagraph]');
        inputcharge.attr('rows', '10');
        inputcharge.attr('cols', '80');
        divcharge.append(labelcharge);
        divcharge.append(inputcharge);


        var inputremove = $("<input>");
        inputremove.attr("class", "btn btn-primary");
        inputremove.attr("onclick", "remove('fieldset_"+ servicequety + "');");
        inputremove.val("remove service");


        fieldset.append(divimage);
        fieldset.append(divname);
        fieldset.append(divcharge);
        fieldset.append(inputremove);

        $("#IdSaveProperties").before(fieldset);

        CKEDITOR.replace( 'Services['+ (servicequety) +'][BounceInLefOneParagraph]' );
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
        servicequety--;
        $('#'+item).remove();
    }

</script>