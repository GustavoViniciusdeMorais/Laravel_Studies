@extends('Page::main')

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Configs</strong>
        </div>

        <div class="card-body">
            <ul>
                @foreach ($configs as $index => $config)
                    <li>
                        {{$index . ' => ' .$config}}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card-footer">
        </div>
    </div>

@endsection
