@extends('layouts.back')

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;  height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>

@section('content')

<a href="{!! route('admin.sectionpages.new') !!}"> new pagesection</a>
        <ul id="sortable">
                
            @foreach($pagesections as $pagesection)
            <li id="{{ $pagesection['id'] }}">
                    @isset($pagesection['id'])
                    <a href="{!! route('admin.sectionpages.edit', ['id' => $pagesection['id']]) !!}">({{$pagesection['order']}}) {{$pagesection['page']['lang'][$locale]['text'] or ''}} - {{$pagesection['section']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sectionpages.edit', ['id' => $pagesection['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {
        
$( function() {
    $( "#sortable" ).sortable({
        opacity                 : 0.6, 
        cursor                  : 'move', 
        tolerance               : 'pointer', 
        revert                  : true, 
        items                   :'li',
        placeholder             : 'state', 
        forcePlaceholderSize    : true,
        update: function(event, ui){
    
//send datas to controller ----------------
            $.ajax({
                url: "{{ route('admin.sectionpages.order') }}",
                type: 'POST',
                data: {
                    "_token"    : $('meta[name="csrf-token"]').attr('content'),
                    "order"     : $( "#sortable" ).sortable('toArray'),
                },
                success: function (data) {
                    console.log(data);
                }

            });
//-------------------------------                                
            }
    });


});

});

</script>
@endsection