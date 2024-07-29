@extends('layouts.app')

@section('content')
@include('layoutcomponents.menu')

<div class="flex justify-center m-5">

    {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) !!}

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            {{ Form::label('name', 'Name:', ['class' => 'block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4']) }}
        </div>
        <div class="md:w-2/3">
            {{ Form::text('name', null, ['class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500', 'required' => '', 'maxlength' => '30']) }}
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            {{ Form::label('description', 'Description:', ['class' => 'block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4']) }}
        </div>
        <div class="md:w-2/3">
            {{ Form::text('description', null, ['class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500', 'required' => '', 'maxlength' => '30']) }}
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            {{ Form::label('price', 'Price:', ['class' => 'block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4']) }}
        </div>
        <div class="md:w-2/3">
            {{ Form::text('price', null, ['class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500', 'required' => '', 'maxlength' => '30']) }}
        </div>
    </div>

    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            {{ Form::submit('Save', ['class' => 'shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded w-full']) }}
        </div>
    </div>

    {!! Form::close() !!}

</div>

@endsection