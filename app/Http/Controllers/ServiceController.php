<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.addService', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sellerId = Auth::user()->seller->id;
        $fileName = "";

        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
            'duration' => 'required',
            'photo' => 'required|file|image|max:2048'
        ]);

        if ($request->photo) {
            $extFile = $request->photo->getClientOriginalExtension();
            $fileName = 'service-' . uniqid() . "-" . time() . "." . $extFile;
        }

        $service = new Service;
        $service->seller_id = $sellerId;
        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->category_id = $request->category;
        $service->photo = $fileName;
        $service->price = $request->price;
        $service->duration = $request->duration;
        $service->save();

        $request->photo->move(public_path("img/uploads"), $fileName);

        Session::flash('message', 'Service has been added !');
        Session::flash('type', 'success');

        return redirect()->route('myStore.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $sales = $service->sale->all();
        $ratings = [];
        $rating = null;

        foreach ($sales as $value) {
            array_push($ratings, $value->rating);
        }

        if (count($ratings) > 0) {
            $rating = array_sum($ratings) / count($ratings);
        }
        return view('pages.detailItem', ['service' => $service, 'rating' => $rating]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('pages.editService', ['service' => $service, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $fileName = "";

        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
            'duration' => 'required',
            'photo' => 'file|image|max:2048'
        ]);

        if ($request->photo) {
            $extFile = $request->photo->getClientOriginalExtension();
            $fileName = 'service-' . uniqid() . "-" . time() . "." . $extFile;
        }

        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->category_id = $request->category;
        $service->price = $request->price;
        $service->duration = $request->duration;
        $service->save();

        if ($fileName) {
            $service->photo = $fileName;
            $service->save();
            $request->photo->move(public_path("img/uploads"), $fileName);
        }

        Session::flash('message', 'Service has been updated !');
        Session::flash('type', 'success');

        return redirect()->route('myStore.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        Service::destroy($id);

        Session::flash('message', 'Service has been deleted !');
        Session::flash('type', 'info');

        return redirect()->route('myStore.index');
    }
}
