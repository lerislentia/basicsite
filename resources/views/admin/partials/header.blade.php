






<div class="sidebar container-fluid">

@if(Auth::user())
<label>
{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
</label>
<div class="btn">
    <a href="{!!route('logout')!!}">{{ __('back.logout') }}</a>
</div>
@endif
        <li>
            <ul>
                <label>{{ __('back.structure') }}</label>
                <li>
                    <a href="{!!route('admin.sites')!!}">{{ __('back.sites') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.pages')!!}">{{ __('back.pages') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.sectionpages')!!}">{{ __('back.pagesection') }} ({{ __('back.order') }})</a>
                </li>
                <li>
                    <a href="{!!route('admin.sections')!!}">{{ __('back.elements') }} (old sections)</a>
                </li>
            </ul>
        </li>

        <li>
            <ul>
                <label>{{ __('back.content') }}</label>
                <li>
                    <a href="{!!route('admin.categories')!!}">{{ __('back.categories') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.products')!!}">{{ __('back.products') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.events')!!}">{{ __('back.events') }}</a>
                </li>        
            </ul>
        </li>
        
        <li>
            <ul>
                <label>{{ __('back.language') }}</label>
                <li>
                    <a href="{!!route('admin.translations')!!}">{{ __('back.translations') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>{{ __('back.baseconfig') }}</label>
                <li>
                    <a href="{!!route('admin.locales')!!}">locales</a>
                </li>
                <li>
                    <a href="{!!route('admin.entities')!!}">{{ __('back.entities') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.types')!!}">{{ __('back.types') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.entitytypes')!!}">{{ __('back.entitietypes') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.states')!!}">{{ __('back.states') }}</a>
                </li>
                <li>
                    <a href="{!!route('admin.entitystates')!!}">{{ __('back.entitiestates') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>{{ __('back.appearance') }}</label>
                <li>
                    <a href="{!!route('admin.layouts')!!}">{{ __('back.layouts') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <ul>
                <label>{{ __('back.performance') }}</label>
                <li>
                    <a href="{{ route('clear-views') }}">{{ __('back.clearviews') }}</a>
                </li>
                <li>
                    <a href="{{ route('clear-cache') }}">{{ __('back.clearcache') }}</a>
                </li>
            </ul>
        </li>
      </ul><br>


</div>

        