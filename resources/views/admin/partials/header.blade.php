






<div class="sidebar container-fluid">

@if(Auth::user())
<label>
{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
</label>
<div class="btn">
    <a href="{!!route('logout')!!}">logout</a>
</div>
@endif
        <li>
            <ul>
                <label>structure</label>
                <li>
                    <a href="{!!route('admin.pages')!!}">pages</a>
                </li>
                <li>
                    <a href="{!!route('admin.sectionpages')!!}">sectionpages</a>
                </li>
                <li>
                    <a href="{!!route('admin.sections')!!}">elements (old sections)</a>
                </li>
            </ul>
        </li>

        <li>
            <ul>
                <label>content</label>
                <li>
                    <a href="{!!route('admin.categories')!!}">categories</a>
                </li>
                <li>
                    <a href="{!!route('admin.products')!!}">products</a>
                </li>
                <li>
                    <a href="{!!route('admin.events')!!}">events</a>
                </li>        
                <li>
                    <a href="{!!route('admin.properties')!!}">properties</a>
                </li>
            </ul>
        </li>
        
        <li>
            <ul>
                <label>internationalization</label>
                <li>
                    <a href="{!!route('admin.translations')!!}">translations</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>base config</label>
                <li>
                    <a href="{!!route('admin.locales')!!}">locales</a>
                </li>
                <li>
                    <a href="{!!route('admin.entities')!!}">entities</a>
                </li>
                <li>
                    <a href="{!!route('admin.types')!!}">types</a>
                </li>
                <li>
                    <a href="{!!route('admin.entitytypes')!!}">entitietypes</a>
                </li>
                <li>
                    <a href="{!!route('admin.states')!!}">states</a>
                </li>
                <li>
                    <a href="{!!route('admin.entitystates')!!}">entitiestates</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>aparience</label>
                <li>
                    <a href="{!!route('admin.layouts')!!}">layouts</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>performance</label>
                <li>
                    <a href="{{ route('clear-views') }}">Clear Views</a>
                </li>
                <li>
                    <a href="{{ route('clear-cache') }}">Clear Cache</a>
                </li>
            </ul>
        </li>
      </ul><br>


</div>

        