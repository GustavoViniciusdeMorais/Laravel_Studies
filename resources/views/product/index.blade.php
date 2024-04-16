@extends('templates.main')

@section('content')
    <h1>Products</h1>
    <ul>
    @foreach ($products as $product)
        <li>{{ $product->id }}, {{ $product->name }}, {{ $product->price }} </li>
    @endforeach
    </ul>
@endsection