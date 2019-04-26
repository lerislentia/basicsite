<div class="col-sm-8 col-md-7 text-left">
          <br>
          <div class="container-fluid">
            <div id="preview">
            </div>
            <div class="tab">
                @foreach($locales as $key => $local)
                @if($local['id'] == $locale)
                <button class="tablinks active" onclick="openTab(event, '{{$local['id']}}')">{{$local['description']}}</button>
                @else
                <button class="tablinks" onclick="openTab(event, '{{$local['id']}}')">{{$local['description']}}</button>
                @endif
                @endforeach

                @foreach($locales as $key => $local)
                @if($local['id'] == $locale)
                <div id="{{$local['id']}}" class="tabcontent" style="display: block;">
                    <div id="properties"></div>
                @else
                    <div id="{{$local['id']}}" class="tabcontent" style="display: none;">
                @endif
                </div>                
                @endforeach
            </div>
          </div>
    </div>