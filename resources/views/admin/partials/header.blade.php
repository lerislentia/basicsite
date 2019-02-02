



{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
<ul class="nav navbar-nav">
    @if(Auth::user())
        <li>
            <a href="{!!route('logout')!!}">logout</a>
        </li>
    @endif
        <li>
            <a href="{{ route('clear-views') }}">Clear Views</a>
        </li>
        <li>
            <a href="{{ route('clear-cache') }}">Clear Cache</a>
        </li>

        <li>
            <a href="{!!route('admin.sections')!!}">elements</a>
        </li>
        <li>
            <a href="{!!route('admin.layouts')!!}">layouts</a>
        </li>
      <li>
            <a href="{!!route('admin.categories')!!}">categories</a>
        </li>

        <li>
            <a href="{!!route('admin.translations')!!}">translations</a>
        </li>
        <li>
            <a href="{!!route('admin.properties')!!}">properties</a>
        </li>
        <li>
            <a href="{!!route('admin.entities')!!}">entities</a>
        </li>
        <li>
            <a href="{!!route('admin.locales')!!}">locales</a>
        </li>
        <li>
            <a href="{!!route('admin.products')!!}">products</a>
        </li>
        <li>
            <a href="{!!route('admin.events')!!}">events</a>
        </li>
        <li>
            <a href="{!!route('admin.states')!!}">states</a>
        </li>
        <li>
            <a href="{!!route('admin.types')!!}">types</a>
        </li>
        <li>
            <a href="{!!route('admin.entities')!!}">entities</a>
        </li>
        <li>
            <a href="{!!route('admin.entitystates')!!}">entitiestates</a>
        </li>
        <li>
            <a href="{!!route('admin.entitytypes')!!}">entitietypes</a>
        </li>
        
      </ul><br>




        