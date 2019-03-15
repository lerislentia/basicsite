@extends('layouts.back')

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;   }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>

@section('content')

        <div class="btn btn-primary">
            <a href="{!! route('admin.sectionpages.new') !!}"> new pagesection</a>
        </div>

        <ul id="sortable">
            @foreach($pagesections as $pagesection)
            <li id="{{ $pagesection['id'] }}">
                    @isset($pagesection['id'])
                    <a href="{!! route('admin.sectionpages.edit', ['id' => $pagesection['id']]) !!}">({{$pagesection['order']}}) {{$pagesection['page']['name'] or ''}} - {{$pagesection['section']['name'] or ''}}</a>
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