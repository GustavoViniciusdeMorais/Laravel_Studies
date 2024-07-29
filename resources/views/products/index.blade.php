@extends('layouts.app')

@section('content')
@include('layoutcomponents.menu')

<div class="container">
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-8 col-centered">
            <h2 class="text-xl font-semibold p-5" style="text-align: center;">
                List of Products
            </h2>
            <a href="/produtos/cadastrar">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                    Add Product
                </button>
            </a>
            <table class="table-auto" >
                <thead>
                    <tr>
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">{{ $product->id }}</th>
                            <td class="border px-4 py-2">{{ $product->name}}</td>
                            <td class="border px-4 py-2">{{ $product->description}}</td>
                            <td class="border px-4 py-2">{{ $product->price}}</td>
                            <td>
                                <div class="inline-flex space-x-4">
                                    {{ Form::open(['route' => ['product.delete', $product->id], 'method' => 'DELETE']) }}
                                        {{ Form::submit('Delete', ['class' => 'bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded']) }}
                                    {{ Form::close() }}
                                    <a href="{{ route('product.edit', $product->id)}}" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection