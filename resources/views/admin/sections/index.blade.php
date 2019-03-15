@extends('layouts.back')

@section('content')

            <div class="btn btn-primary">
                <a href="{!! route('admin.sections.new') !!}"> new element</a>
            </div>

        <ul>
            
            @foreach($sections as $section)
            <li>
                
                    @isset($section['name'])
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">{{$section['name'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">unstranslated</a>
                    @endisset

                    @if(count($section['childrens'])>0)

                    <ul>
                        @foreach($section['childrens'] as $sectionone)
                        <li>
                            ({{$sectionone['order']}}) - 
                                @isset($sectionone['name'])
                                <a href="{!! route('admin.sections.edit', ['id' => $sectionone['id']]) !!}">{{$sectionone['name'] or ''}}</a>
                                @else
                                <a href="{!! route('admin.sections.edit', ['id' => $sectionone['id']]) !!}">unstranslated</a>
                                @endisset

                                @if(count($sectionone['childrens'])>0)

                                
                                @endif
                        </li>
                        @endforeach
                    </ul>


                    @endif
            </li>
            @endforeach
        </ul>
@endsection