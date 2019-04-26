@extends('layouts.back')

@section('content')

        <div class="btn btn-primary">
            <a href="{!! route('admin.products.new') !!}"> new product</a>
        </div>

        <ul id="sortable">
            @foreach($products as $product)
            <li id="{{ $product['id'] }}">
                    @isset($product['id'])
                    <a href="{!! route('admin.products.edit', ['id' => $product['id']]) !!}">{{$product['name_value']['lang'][$locale]['text'] or ''}}</a>
                    @else
                    <a href="{!! route('admin.products.edit', ['id' => $product['id']]) !!}">unstranslated</a>
                    @endisset
            </li>
            @endforeach
        </ul>

@endsection