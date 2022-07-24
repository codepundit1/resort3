<?php

namespace App\Http\Controllers;

use App\Models\Resort;
use Illuminate\Http\Request;

class ResortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resorts = Resort::latest()->get();

        return response()->json($resorts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'location' => 'required',
            'description'=>'required',
            'image'=>'required|image|max:2048',
            'price'=>'required|integer'
        ]);

        $resort = Resort::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
        ]);



        if($request->image){
            $imageName = time().'_'. uniqid() .'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/resort'), $imageName);
            $resort->image = '/storage/resort/' . $imageName;
            $resort->save();
        }

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resort  $resort
     * @return \Illuminate\Http\Response
     */
    public function show(Resort $resort)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resort  $resort
     * @return \Illuminate\Http\Response
     */
    public function edit(Resort $resort)
    {
        if($resort){
            return response()->json($resort, 200);

        }else{
            return response()->json('falied', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resort  $resort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resort $resort)
    {
        $this->validate($request, [
            'name' => "required|unique:resorts,name, $resort->id",

        ]);

        $resort->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
        ]);


        // if($request->image){
        //     $imageName = time().'_'. uniqid() .'.'.$request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('storage/resort'), $imageName);
        //     $resort->image = '/storage/resort/' . $imageName;
        //     $resort->save();
        // }

        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resort  $resort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resort $resort)
    {
        if($resort){

            $resort->delete();
            return response()->json($resort, 200);

        }else{
            return response()->json('falied', 404);
        }
    }
}
