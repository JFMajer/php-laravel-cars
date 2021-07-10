<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;
use App\Models\Headquarter;
use App\Http\Requests\CreateValidationRequest;

class CarsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::paginate(3);
        

        //var_dump($cars);
        
        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //Methods we can use on $request
        // $test = $request->file('image')->guessExtension();
        // dd($test);

        //dd($request->all());
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
            'name' => 'required|max:255|unique:cars',
            'description' => 'required|max:255',
            'founded' => 'required|integer|min:1800|max:2021'
        ]);

        $newImageName = time().'-'.$request->name.'.'.$request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        //Check if request is /cars and store in DB
        if ($request->is('cars')) {
            $car = Car::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'founded' => $request->input('founded'),
                'image_path' => $newImageName,
                'user_id' => auth()->user()->id
            ]);
        }

        // $car = new Car;
        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');

        // $car->save();
        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);

        $car = Car::find($id);
        //$hq = Headquarter::find($id);
        $products = Product::find($id);
        print_r($products);
        //dd($car);

        return view('cars.show')->with('car', $car);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $car = Car::find($id);
        //dd($car);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $car = Car::where('id', $id)->update([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description')
        ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //dd($id);
        //$car = Car::find($id);
        $car->delete();
        return redirect('/cars');

    }
}

