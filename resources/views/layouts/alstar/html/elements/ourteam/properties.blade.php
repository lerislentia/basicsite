

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

        <input id="IdAddPartner" type="button" value="add partner" class="btn btn-primary">

        @isset($element['array_data'][$locale]['Partners'])
            @foreach($element['array_data'][$locale]['Partners'] as $key => $Partner)
            <fieldset id="fieldset_{{$key}}">

                <div class="form-group">
                    <label for="Partners[{{$key}}]LargeImage">
                        large image
                    </label>
                    <input type="text" name="Partners[{{$key}}][LargeImage]" onclick="browseServer(this);" class="form-control" value="{{ isset($Partner['LargeImage']) ? $Partner['LargeImage'] : old('LargeImage') }}">
                    
                </div>

                <div class="form-group">
                    <label for="Partners[{{$key}}][Name]">
                        name
                    </label>
                    <input type="text" name="Partners[{{$key}}][Name]" class="form-control" value="{{ isset($Partner['Name']) ? $Partner['Name'] : old('Name') }}">
                </div>

                <div class="form-group">
                    <label for="Partners[{{$key}}][Charge]">
                        charge
                    </label>
                    <input type="text" name="Partners[{{$key}}][Charge]" class="form-control" value="{{ isset($Partner['Charge']) ? $Partner['Charge'] : old('Charge') }}">
                </div>

                <input type="button" value="remove partner" class="btn btn-primary" onclick="remove('fieldset_{{$key}}');">

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

if(isset($element['array_data'][$locale]['Partners'])){
    $partnerquety = count($element['array_data'][$locale]['Partners']);
}else{
    $partnerquety = 0;
}
@endphp

var partquetity = "{{$partnerquety}}";

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

    $("#IdAddPartner").click(function(){

    partquetity++;

    var fieldset = $("<fieldset></fieldset>");
    fieldset.attr("id","fieldset_" + partquetity);

    var divimage      = $("<div></div>");
    divimage.attr('class', 'form-group');

    var labelimage    = $("<label></label>");
    labelimage.html("large image");
    labelimage.attr('for', 'Partners[' + (partquetity) + ']LargeImage');

    var inputimage    = $("<input>");

    inputimage.attr('type', 'text');
    inputimage.attr('name', 'Partners[' + (partquetity) + ']LargeImage');
    inputimage.attr('onclick', 'browseServer(this);');

    divimage.append(labelimage);
    divimage.append(inputimage);

    var fieldset = $("<fieldset></fieldset>");
    fieldset.attr("id","fieldset_" + partquetity);

    var divname = $("<div></div>");
    divname.attr('class', 'form-group');

    var labelname    = $("<label></label>");
    labelname.html("Name");
    labelname.attr('for', 'Partners['+ (partquetity) +'][Name]');

    var inputname    = $("<input>");

    inputname.attr('type', 'text');
    inputname.attr('name', 'Partners['+ (partquetity) +'][Name]');
    divname.append(labelname);
    divname.append(inputname);


    var divcharge = $("<div></div>");
    divcharge.attr('class', 'form-group');

    var labelcharge    = $("<label></label>");
    labelcharge.html("Charge");
    labelcharge.attr('for', 'Partners['+ (partquetity) +'][Charge]');

    var inputcharge    = $("<input>");

    inputcharge.attr('type', 'text');
    inputcharge.attr('name', 'Partners['+ (partquetity) +'][Charge]');
    divcharge.append(labelcharge);
    divcharge.append(inputcharge);


    var inputremove = $("<input>");
    inputremove.attr("class", "btn btn-primary");
    inputremove.attr("onclick", "remove('fieldset_"+ partquetity + "');");
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
    partquetity--;
    $('#'+item).remove();
    }

});


    

</script>