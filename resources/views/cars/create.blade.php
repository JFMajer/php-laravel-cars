@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Create a new car
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/cars" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block">
                <input type="file" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400 border-solid border-4 border-light-blue-500" name="image">
                <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400 border-solid border-4 border-light-blue-500" name="name" placeholder="Brand name...">
                <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400 border-solid border-4 border-light-blue-500" name="founded" placeholder="founded">
                <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400 border-solid border-4 border-light-blue-500" name="description" placeholder="description">
                <button type="submit" class="bg-green-500 hover:bg-green-700 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">Submit</button>
            </div>
        </form>
    </div>
    @if ($errors->any()) 
    <div class="w-4/8 m-auto text-center">
        <ul class="bg-red-500 list-inline text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        
    @endif

@endsection