@extends('layouts.admin')

@section('content')

    <h4>basic information</h4>
    <form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">
            name
        </label>
            <input type="text" name="name" value="{{ isset($secti['name_value']['lang'][$locale]['text']) ? $secti['name_value']['lang'][$locale]['text'] : old('name') }}">
        </div>

        <div class="form-group">
            <label for="type">
                type
            </label>
            <select name="type_id" id="IdType">
            <option value="" {{($secti['type_id'] == null ? 'selected="selected"': '')}}> - </option>
                    @foreach($entitytypes as $entitytype)
                        <option value="{{$entitytype['type_id']}}" {{($secti['type_id'] == $entitytype['type_id']) ? 'selected="selected"': ''}}>
                            {{$entitytype['type']['lang'][$locale]['text'] or ''}}
                        </option>
                    @endforeach
                </select>
        </div>

        <div class="form-group">
            <label for="section">
                section
            </label>
            <select name="section_id">
            <option value="" {{($secti['type_id'] == null ? 'selected="selected"': '')}}> - </option>
                    @foreach($sections as $section)
                        <option value="{{$section['id']}}" {{($secti['type_id'] == $section['id']) ? 'selected="selected"': ''}}>
                            {{$section['name_value']['lang'][$locale]['text'] or ''}}
                        </option>
                    @endforeach
                </select>
        </div>

        <div class="form-group">
            <label for="state">
                state
            </label>
            <select name="state_id">
            <option value="" {{($secti['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                    @foreach($entitystates as $entitystate)
                        <option value="{{$entitystate['state_id']}}" {{($secti['state_id'] == $entitystate['state_id']) ? 'selected="selected"': ''}}>
                            {{$entitystate['state']['lang'][$locale]['text'] or ''}}
                        </option>
                    @endforeach
                </select>
        </div>

        <div class="form-group">
            <label for="order">
                order
                    </label>
            <input type="text" name="order" value="{{ isset($element['order']) ? $element['order'] : old('order') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="submit" value="save">
    </form>

@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {

    $("#IdType").change(function() {
        LoadTypeContent($("#IdType").val());
    });
});

function LoadTypeContent(type){
    $( "#preview" ).html("");
    $( "#preview" ).load( "{{route('admin.type.preview.ajax')}}", { "type": type , "_token": $('meta[name="csrf-token"]').attr('content')} );

        $.ajax({
                url: "{{ route('admin.type.ajax') }}",
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'), 
                    "type":type
                    },
                    dataType: "json",

                success: function (data) {
                    $.each(data, function (index, value) {

                        var $formgroup  = $("<div />").attr( "class", "form-group var" );
                        var $label       = $("<label />").attr( "for", index ).text( index );;

                        var $input = $("<input/>")
                                        .attr( "type", "text" )
                                        .attr( "id", "id"+index )
                                        .attr( "name", index );
                        $formgroup.append($label);
                        $formgroup.append($input);
                        $($formgroup).insertBefore("#MyForm");

                    })

                },
                error: function () {
                    console.log("[ERROR] Method: LoadTypeContent()");

                }
           });
        
    }


</script>
@endsection