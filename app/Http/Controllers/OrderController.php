<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Service;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hashids\Hashids;
use Illuminate\Support\Facades\Notification;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Auth::user()->order->where('status', '<>', 'Completed');
        return view('pages.buyOrder', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hashids = new Hashids('', 15);
        $id = $hashids->encode($request->id);

        return redirect()->route('order.form', ['id' => $id]);
    }

    public function orderForm($id)
    {
        $hashids = new Hashids('', 15);
        $serviceId = $hashids->decode($id);

        $service = Service::find($serviceId)->first();

        if ($service) {
            return view('pages.createOrder', ['service' => $service]);
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $seller = Seller::find($request->seller_id)->user;
        $service = Service::find($request->service_id);

        $order = new Order;
        $order->service_id = $request->service_id;
        $order->seller_id = $request->seller_id;
        $order->buyer_id = $user->id;
        $order->note = $request->note;
        $order->price = $request->price;
        $order->status = "Waiting";
        $order->save();

        Notification::send($seller, new OrderNotification($user->name, $service->service_name));

        Session::flash('message', 'Order has been added !');
        Session::flash('type', 'success');

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function ordersFilter($status)
    {
        $status = ucwords($status);

        if ($status == 'Waiting' || $status == 'Accepted' || $status == 'In Process' || $status == 'Done') {
            $orders = Auth::user()->order->where('status', $status);
            return view('pages.buyOrder', ['orders' => $orders]);
        } else {
            return abort(404);
        }
    }
}
