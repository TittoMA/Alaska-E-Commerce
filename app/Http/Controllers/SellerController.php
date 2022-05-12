<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;
use App\Notifications\ProgressNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sellerRegister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $fileName = "";

        $request->validate([
            'store_name' => 'required',
            'provide' => 'required',
            'about' => 'required',
            'photo' => 'file|image|max:4096'
        ]);

        if ($request->photo) {
            $extFile = $request->photo->getClientOriginalExtension();
            $fileName = 'header-' . uniqid() . "-" . time() . "." . $extFile;
        }

        $create = Seller::create([
            'user_id' => $userId,
            'store_name' => $request->store_name,
            'about' => $request->about,
            'provide' => $request->provide,
            'header_photo' => $fileName,
        ]);

        if ($fileName) {
            $request->photo->move(public_path("img/header"), $fileName);
        }

        if ($create) {
            $user = User::find($userId);
            $user->user_type = 'Seller';
            $user->save();
        }

        Session::flash('message', 'you have successfully registered!');
        Session::flash('type', 'success');

        return redirect()->route('myStore.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        $ratings = array();
        $orders = $seller->order;
        $sellerRating = null;

        foreach ($orders as $item) {
            $sale = $item->sale;
            if ($sale) {
                array_push($ratings, $sale->seller_rating);
            }
        }

        if (count($ratings)) {
            $rate = array_sum($ratings) / count($ratings);

            $sellerRating = round($rate, 1);
        }

        return view('pages.store', ['seller' => $seller, 'sellerRating' => $sellerRating]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $seller = Auth::user()->seller;
        return view('pages.editStore', ['seller' => $seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->seller->id;
        $seller = Seller::find($id);

        $request->validate([
            'store_name' => 'required',
            'provide' => 'required',
            'about' => 'required'
        ]);

        $seller->store_name = $request->store_name;
        $seller->provide = $request->provide;
        $seller->about = $request->about;
        $seller->save();

        if ($seller->wasChanged()) {
            Session::flash('message', 'Success Update Information');
            Session::flash('type', 'success');

            return redirect()->route('myStore.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }

    public function myStore()
    {
        $seller = Auth::user()->seller;
        $services = $seller->service;
        $sale = new Sale;

        $ratings = array();
        $orders = $seller->order;
        $sellerRating = null;

        foreach ($orders as $item) {
            $sale = $item->sale;
            if ($sale) {
                array_push($ratings, $sale->seller_rating);
            }
        }

        if (count($ratings)) {
            $rate = array_sum($ratings) / count($ratings);

            $sellerRating = round($rate, 1);
        }

        return view('pages.myStore', ['seller' => $seller, 'services' => $services, 'sale' => $sale, 'sellerRating' => $sellerRating]);
    }

    public function updateHeader(Request $request)
    {
        $id = Auth::user()->seller->id;
        $seller = Seller::find($id);

        $request->validate([
            'photo' => 'required|file|image|max:4096'
        ]);

        $extFile = $request->photo->getClientOriginalExtension();
        $fileName = 'header-' . uniqid() . "-" . time() . "." . $extFile;

        $seller->header_photo = $fileName;
        $seller->save();

        if ($seller->wasChanged()) {
            $request->photo->move(public_path("img/header"), $fileName);

            Session::flash('message', 'Success Update Header Photo');
            Session::flash('type', 'success');

            return redirect()->route('myStore.index');
        }
    }

    public function orders()
    {
        $sellerId = Auth::user()->seller->id;
        $orders = Seller::find($sellerId)->order;
        return view('pages.sellerOrder', ['orders' => $orders]);
    }

    public function ordersFilter($status)
    {
        $sellerId = Auth::user()->seller->id;

        $status = ucwords($status);
        $orders = Seller::find($sellerId)->order->where('status', $status);
        return view('pages.sellerOrder', ['orders' => $orders]);
    }

    public function orderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required'
        ]);

        $order = Order::find($request->order_id);

        $order->status = $request->status;
        $order->save();

        Notification::send($order->buyer, new ProgressNotification($request->status, $order->service->service_name));

        return redirect()->route('myStore.orders');
    }

    public function statistic()
    {
        $seller = Auth::user()->seller;

        $sold = array();
        $services = $seller->service;
        $totalSold = null;

        foreach ($services as $item) {
            array_push($sold, $item->sold);
        }

        if (count($sold)) {
            $totalSold = array_sum($sold);
        }

        $ratings = array();
        $orders = $seller->order;
        $sellerRating = null;

        foreach ($orders as $item) {
            $sale = $item->sale;
            if ($sale) {
                array_push($ratings, $sale->seller_rating);
            }
        }

        if (count($ratings)) {
            $rate = array_sum($ratings) / count($ratings);

            $sellerRating = round($rate, 1);
        }

        $income = array();
        $totalIncome = null;

        foreach ($orders as $item) {
            $sale = $item->sale;
            if ($sale) {
                array_push($income, $sale->price);
            }
        }

        if (count($income)) {
            $totalIncome = array_sum($income);
        }

        return view(
            'pages.storeStatistic',
            [
                'seller' => $seller,
                'totalSold' => $totalSold,
                'sellerRating' => $sellerRating,
                'totalIncome' => $totalIncome
            ]
        );
    }
}
