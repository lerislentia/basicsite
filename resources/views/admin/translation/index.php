

<div class="tab">
    @foreach($locales as $key => $locale)
    <button class="tablinks" onclick="openTab(event, '{{$key}}')">{{$locale['description']}}</button>
    @endforeach

    @foreach($locales as $key => $locale)
    <div id="{{$key}}" class="tabcontent">
    <h3>{{$locale['description']}}</h3>
    <div id="properties"></div>
    </div>                
    @endforeach
</div>

<script>
        function openTab(evt, key) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(key).style.display = "block";
        evt.currentTarget.className += " active";
        }
    </script>