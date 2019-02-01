@extends('layouts.back')

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
                @foreach($types as $type)
                    <option value="{{$type['id']}}" {{($type['id'] == $secti['type_id']) ? 'selected="selected"': ''}}>
                        {{$type['name_value']['lang'][$locale]['text']}}
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

    LoadTypeProperties($("#IdType").val(), $("#IdElement").val() );
    LoadTypeContent($("#IdType").val());

    $("#IdType").change(function() {
        LoadTypeContent($("#IdType").val());
        LoadTypeProperties($("#IdType").val(), $("#IdElement").val() );
    });
});

function LoadTypeContent(type){

    $( "#preview" ).html("");
    $( "#properties" ).html("");

    if(type==''){
        return false;
    }

    $( "#preview" ).load(
                "{{route('admin.type.preview.ajax')}}", 
                { 
                "type"  : type , 
                "_token": $('meta[name="csrf-token"]').attr('content')
                } 
            );
    }

    
function LoadTypeProperties(type, entity){
    if(type==null || entity==null){
        return false;
    }

$( "#properties" ).html("");
$( "#properties" ).load(
            "{{route('admin.type.properties.ajax')}}", 
            { 
            "type"  : type , 
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "entity_id": entity,
            } 
        );
}

</script>
@endsection

