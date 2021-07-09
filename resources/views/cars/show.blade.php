@extends('layouts.app')

{{ $car->headquarter}}

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <img src="{{ asset('images/'.$car->image_path) }}" alt="" class="w-6/12 mb-8 shadow-xl" >
            <h1 class="text-5xl uppercase bold">
                {{ $car->name }}
            </h1>

            <p class="text-lg py-6">
                {{-- {{ $car->headquarter->headquarters }}, {{ $car->headquarter->country }} --}}
            </p>
        </div>

        <div class="py-10 text-center">

            <span class="uppercase text-blue-500 font-bold-text-xs italic">Founded: {{ $car->founded }}</span>
            <h2 class="text-gray-700 text-5xl py-6 hover:text-gray-500"></h2>
            <p class="text-lg text-gray-700 py-6">
                {{ $car->description }}
            </p>

            <table class="table-auto">
                <tr class="bg-blue-100">
                    <th class="w-1/4 border-4 border-gray-500">Model</th>
                    <th class="w-1/4 border-4 border-gray-500">Engines</th>
                    <th class="w-1/4 border-4 border-gray-500">Date</th>
                </tr>
                @forelse ($car->carModels as $model)
                    <tr>
                        <td class="border-4 border-gray-500">{{ $model->model_name }}</td>
                        <td class="border-4 border-gray-500">
                            @foreach ($car->engines as $engine)
                                @if ($model->id == $engine->model_id)
                                    {{ $engine->engine_name }}
                                @endif
                            @endforeach
                        </td>
                        <td class="border-4 border-gray-500">
                            @foreach ($car->productionDate as $date)
                                {{ $date }}
                                <br
                                {{-- @if ($date->model_id == $model->id)
                                {{ date('d-m-y', strtotime($car->productionDate->created_at)) }}
                                @endif --}}
                            @endforeach
                        </td>

                    </tr>
                @empty
                    <p>No car models found</p>
                @endforelse
            </table>
            <p class="text-left">
                Product types:
                @forelse ($car->products as $product)
                    {{ $product->name }}
                    
                @empty
                    <p>No car product description</p>
                @endforelse
            </p>

            <hr class="mt-4 mb-8">
        </div>



    </div>

    @foreach ($car->carModels as $model)
        {{ $model->model_name }}
    @endforeach

@endsection
