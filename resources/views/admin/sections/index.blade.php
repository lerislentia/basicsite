@extends('layouts.back')

@section('content')

<a href="{!! route('admin.sections.new') !!}"> new element</a>
        <ul>
            @foreach($sections as $section)
            <li>
                ({{$section['order']}}) - 
                    @isset($section['name_value']['lang'][$locale])
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">{{$section['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.sections.edit', ['id' => $section['id']]) !!}">unstranslated</a>
                    @endisset

                    @if(count($section['childrens'])>0)

                    <ul>
                        @foreach($section['childrens'] as $sectionone)
                        <li>
                            ({{$sectionone['order']}}) - 
                                @isset($sectionone['name_value']['lang'][$locale])
                                <a href="{!! route('admin.sections.edit', ['id' => $sectionone['id']]) !!}">{{$sectionone['name_value']['lang'][$locale]['text'] or ''}}</a>
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