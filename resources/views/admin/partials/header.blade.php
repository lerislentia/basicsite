<!-- Nav -->
<div>
{{ Config::get('app.locale') }}
</div>
<nav id="nav">
    <ul>
        <li>
            <a href="{!!route('admin.categories')!!}">categories</a>
        </li>
        <li>
            <a href="{!!route('admin.sections')!!}">sections</a>
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
    </ul>
</nav>