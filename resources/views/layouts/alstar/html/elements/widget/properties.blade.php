

<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
            <div class="form-group">
                <label for="Mainoffice">
                    mainoffice
                </label>
                <textarea id="IdMainoffice" rows="10" cols="80" name="Mainoffice">
                {!! isset($element['array_data'][$locale]['Mainoffice']) ? $element['array_data'][$locale]['Mainoffice'] : old('Mainoffice') !!}
                </textarea>
            </div>
            <div class="form-group">
                <label for="Call">
                    call
                </label>
                <textarea id="IdCall" rows="10" cols="80" name="Call">
                {!! isset($element['array_data'][$locale]['Call']) ? $element['array_data'][$locale]['Call'] : old('Call') !!}
                </textarea>
            </div>
            <div class="form-group">
                <label for="Emailus">
                    emailus
                </label>
                <textarea id="IdEmailus" rows="10" cols="80" name="Emailus">
                {!! isset($element['array_data'][$locale]['Emailus']) ? $element['array_data'][$locale]['Emailus'] : old('Emailus') !!}
                </textarea>
            </div>
            <div class="form-group">
                <label for="Facebook">
                    facebook link
                </label>
                <input type="text" name="Facebook" class="form-control" value="{!! isset($element['array_data'][$locale]['Facebook']) ? $element['array_data'][$locale]['Facebook'] : old('Facebook') !!}">
            </div>
            <div class="form-group">
                <label for="Instagram">
                    instagram link
                </label>
                <input type="text" name="Instagram" class="form-control" value="{!! isset($element['array_data'][$locale]['Instagram']) ? $element['array_data'][$locale]['Instagram'] : old('Instagram') !!}">
            </div>
            <div class="form-group">
                <label for="Twitter">
                    twitter link
                </label>
                <input type="text" name="Twitter" class="form-control" value="{!! isset($element['array_data'][$locale]['Twitter']) ? $element['array_data'][$locale]['Twitter'] : old('Twitter') !!}">
            </div>
            <div class="form-group">
                <label for="Pinterest">
                    pinterest link
                </label>
                <input type="text" name="Pinterest" class="form-control" value="{!! isset($element['array_data'][$locale]['Pinterest']) ? $element['array_data'][$locale]['Pinterest'] : old('Pinterest') !!}">
            </div>
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

    CKEDITOR.replace( "IdMainoffice" );
    CKEDITOR.replace( "IdCall" );
    CKEDITOR.replace( "IdEmailus" );
    
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

});

</script>