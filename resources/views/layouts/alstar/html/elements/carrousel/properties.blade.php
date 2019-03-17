<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <input id="IdAddSlide" type="button" value="add slide" class="btn btn-secondary">

        @isset($element['array_data'][$locale]['Slides'])
            @foreach($element['array_data'][$locale]['Slides'] as $key => $Slide)
            
            <fieldset id="fieldset_{{$key}}" style="">

                <div class="form-group">
                    <label for="Slides[{{$key}}][LargeImage]">
                        large image
                    </label>
                    <input type="text" name="Slides[{{$key}}][LargeImage]" class="form-control" onclick="browseServer(this);" value="{{ isset($Slide['LargeImage']) ? $Slide['LargeImage'] : old('LargeImage') }}">
                </div>
                <div class="form-group">
                    <label for="Slides[{{$key}}][FadeInDown]">
                        fadeInDown
                    </label>
                    <input id="IdFadeInDown" type="text" name="Slides[{{$key}}][FadeInDown]" class="form-control" value="{{ isset($Slide['FadeInDown']) ? $Slide['FadeInDown'] : old('FadeInDown') }}">
                </div>

                <div class="form-group">
                    <label for="Slides[{{$key}}][FadeInUp]">
                        fadeInUp
                    </label>
                    <input id="IdFadeInUp" type="text" name="Slides[{{$key}}][FadeInUp]" class="form-control" value="{{ isset($Slide['FadeInUp']) ? $Slide['FadeInUp'] : old('FadeInUp') }}">
                </div>

                <input type="button" value="remove slide" class="btn btn-secondary" onclick="remove('fieldset_{{$key}}');">

            </fieldset>
            @endforeach
        @endisset

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <input type="hidden" id="IdTypeId" name="type" value="{{$element['type_id']}}">
        <input id="IdSaveProperties" type="button" class="btn btn-primary" value="{{ __('back.save') }}">
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
    inputimage.attr('class', 'form-control');

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
    inputname.attr('class', 'form-control');
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
    inputcharge.attr('class', 'form-control');
    divcharge.append(labelcharge);
    divcharge.append(inputcharge);


    var inputremove = $("<input>");
    inputremove.attr("class", "btn btn-secondary");
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