<div class="container">
<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <fieldset>
            <legend>Properties:</legend>

            <div class="form-group">
                <label for="image">
                    image background
                </label>
                <input id="IdImage" type="text" name="image" class="form-control" onclick="browseServer(this);" value="{{ isset($element['array_data'][$locale]['image']) ? $element['array_data'][$locale]['image'] : old('image') }}">
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

});

    

</script>