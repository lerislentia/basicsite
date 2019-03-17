

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

        <input id="IdAddWork" type="button" value="add work" class="btn btn-primary">

        @isset($element['array_data'][$locale]['works'])
            @foreach($element['array_data'][$locale]['works'] as $key => $work)
            <fieldset id="fieldset_{{$key}}">
                <div class="form-group">
                    <label for="works[{{$key}}]LargeImage">
                        large image
                    </label>
                    <input type="text" name="works[{{$key}}][LargeImage]" onclick="browseServer(this);" class="form-control" value="{{ isset($work['LargeImage']) ? $work['LargeImage'] : old('LargeImage') }}">
                    
                </div>

                <div class="form-group">
                    <label for="works[{{$key}}]ThumbImage">
                        thumb image
                    </label>
                    <input type="text" name="works[{{$key}}][ThumbImage]" onclick="browseServer(this);" class="form-control" value="{{ isset($work['ThumbImage']) ? $work['ThumbImage'] : old('ThumbImage') }}">
                    
                </div>

                <div class="form-group">
                    <label for="works[{{$key}}]Title">
                        title
                    </label>
                    <input type="text" name="works[{{$key}}][Title]" class="form-control" value="{{ isset($work['Title']) ? $work['Title'] : old('Title') }}">
                </div>

                <div class="form-group">
                    <label for="works[{{$key}}]Description">
                        description
                    </label>
                    <textarea name="works[{{$key}}][Description]" rows="10" cols="80">
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
        <input id="IdSaveProperties" type="button" value="{{ __('back.save') }}">
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
        labelimage.attr('for', 'works[' + (workquetity) + ']LargeImage');

        var inputimage    = $("<input>");

        inputimage.attr('type', 'text');
        inputimage.attr('name', 'works[' + (workquetity) + ']LargeImage');
        inputimage.attr('onclick', 'browseServer(this);');

        divimage.append(labelimage);
        divimage.append(inputimage);

        var divthumb        = $("<div></div>");
        divthumb.attr('class', 'form-group');

        var labeltimage     = $("<label></label>");
        labeltimage.html("thumb image");
        labeltimage.attr('for', 'works[' + (workquetity) + ']ThumbImage');

        var inputthumbimage = $("<input>");
        inputthumbimage.attr('type', 'text');
        inputthumbimage.attr('name', 'works[' + (workquetity) + ']ThumbImage');
        inputthumbimage.attr('onclick', 'browseServer(this);');

        divthumb.append(labeltimage);
        divthumb.append(inputthumbimage);

        var divtitle = $("<div></div>");
        divtitle.attr('class', 'form-group');

        var labeltitle    = $("<label></label>");
        labeltitle.html("title");
        labeltitle.attr('for', 'works['+ (workquetity) +'][Title]');

        var inputtitle    = $("<input>");

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
        fieldset.append(divthumb);
        fieldset.append(divtitle);
        fieldset.append(divdescription);
        fieldset.append(inputremove);
        $("#IdSaveProperties").before(fieldset);

        CKEDITOR.replace( 'works['+ (workquetity) +'][Description]' );

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
        workquetity--;
        $('#'+item).remove();
    }

});

</script>