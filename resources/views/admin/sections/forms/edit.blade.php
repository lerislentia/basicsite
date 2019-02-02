@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        name
    </label>
        <input type="text" name="name" value="{{ isset($currentsection['name_value']['lang'][$locale]['text']) ? $currentsection['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
                description
                </label>
        <input type="text" name="description" value="{{ isset($currentsection['description_value']['lang'][$locale]['text']) ? $currentsection['description_value']['lang'][$locale]['text'] : old('description') }}">
    </div>

    <div class="form-group">
        <label for="url">
                url
                </label>
        <input type="text" name="url" value="{{ isset($currentsection['url']) ? $currentsection['url'] : old('url') }}">
    </div>
    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($currentsection['tags']) ? $currentsection['tags'] : old('tags') }}">
    </div>
    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($currentsection['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['state_id']}}" {{($state['state_id'] == $currentsection['state_id']) ? 'selected="selected"': ''}}>
                        {{$state['state']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>

    <div class="form-group">
        <label for="parent_id">
                    parent_id
                </label>
        <select name="parent_id">
        <option value="" {{($currentsection['parent_id'] == null ? 'selected="selected"': '')}}> - </option>
            @foreach($sections as $section)
                <option value="{{$section['id']}}" {{($section['id'] == $currentsection['parent_id']) ? 'selected="selected"': ''}}>
                    {{$section['name_value']['lang'][$locale]['text']}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="type">
            type
        </label>
        <select name="type_id" id="IdType">
        <option value="" {{($currentsection['type_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($types as $type)
                    <option value="{{$type['id']}}" {{($type['id'] == $currentsection['type_id']) ? 'selected="selected"': ''}}>
                        {{$type['name_value']['lang'][$locale]['text']}}
                    </option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="order">
            order
                </label>
        <input type="text" name="order" value="{{ isset($currentsection['order']) ? $currentsection['order'] : old('order') }}">
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    <input type="hidden" id="IdEntity" value="{{$currentsection['id']}}">
    {{ csrf_field() }}
    <input type="submit" value="save">
</form>

<form action="{{route('admin.sections.delete', ['id' => $currentsection['id']])}}" method="POST">
{{ csrf_field() }}
<input type="submit" value="delete">
</form>

<!-- <a href="{{route('admin.sections.properties.edit', ['id' => $currentsection['id']])}}">properties</a> -->

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function () {

    LoadAll();

    $("#IdType").change(function() {
        LoadAll();
    });
});

function LoadAll(){

    LoadProperties();
    Loadpreview();
    
}

function Loadpreview(){

    var type    = $("#IdType").val();
    var entity  = $("#IdEntity").val();

    if(type==''){
        return false;
    }

    $( "#preview" ).html("");

    $( "#preview" ).load(
                "{{route('admin.type.preview.ajax')}}",
                {
                "type"      : type ,
                "entity_id" : entity ,
                "_token"    : $('meta[name="csrf-token"]').attr('content')
                }
            );
    }

function LoadProperties(){

    var type    = $("#IdType").val();
    var entity  = $("#IdEntity").val();

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