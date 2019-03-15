@extends('layouts.back')

@section('content')

<form action="" method="POST">

    <div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" value="{{ isset($currentpage['name']) ? $currentpage['name'] : old('name') }}">
    </div>

    <div class="form-group">
        <label for="tags">
                    tags
                </label>
        <input type="text" name="tags" value="{{ isset($currentpage['tags']) ? $currentpage['tags'] : old('tags') }}">
    </div>

    <div class="form-group">
        <label for="state">
            state
        </label>
        <select name="state_id">
        <option value="" {{($currentpage['state_id'] == null ? 'selected="selected"': '')}}> - </option>
                @foreach($states as $state)
                    <option value="{{$state['id']}}" {{($state['id'] == $currentpage['state_id']) ? 'selected="selected"': ''}}>
                        {{$state['name']}}
                    </option>
                @endforeach
            </select>
    </div>

    <input type="hidden" name="locale" value="{{$locale}}">
    <input type="hidden" id="IdEntity" value="{{$currentpage['id']}}">
    {{ csrf_field() }}
    <input type="submit" value="{{ __('back.save') }}">
</form>

<form action="{{route('admin.pages.delete', ['id' => $currentpage['id']])}}" method="POST">
{{ csrf_field() }}
<input type="submit" value="delete">
</form>




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
        "type"      : type ,
        "entity_id" : entity ,
        "_token"    : $('meta[name="csrf-token"]').attr('content'),
        "entity_id" : entity,
        }
    );
}

</script>
@endsection