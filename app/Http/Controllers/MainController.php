<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sale;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class MainController extends Controller
{
    public function index()
    {
        
        $categories = Category::all();

        $services = Service::with('sale')->get();

        $new = collect();

        foreach ($services as $val) {

            $pur = $val->sale;
            $store_name = $val->seller->store_name;

            $ratings = array();
            $totalRating = null;
            foreach ($pur as $value) {
                array_push($ratings, $value->rating);
            }

            if (count($ratings)) {
                $rate = array_sum($ratings) / count($ratings);
                $totalRating = round($rate, 1);
            }

            $a = collect();
            $a->put('id', $val->id);
            $a->put('seller_id', $val->seller_id);
            $a->put('service_name', $val->service_name);
            $a->put('store_name', $store_name);
            $a->put('description', $val->description);
            $a->put('photo', $val->photo);
            $a->put('price', $val->price);
            $a->put('rating', $totalRating);

            $new->add($a);
        }

        $sorted = $new->sortByDesc('rating')->take(4);
        return view('pages.main', ['services' => $sorted, 'categories' => $categories]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function popularity()
    {
        $services = Service::with('sale')->get();

        $new = collect();

        foreach ($services as $val) {

            $pur = $val->sale;

            $ratings = array();
            $totalRating = null;
            foreach ($pur as $value) {
                array_push($ratings, $value->rating);
            }

            if (count($ratings)) {
                $rate = array_sum($ratings) / count($ratings);
                $totalRating = round($rate, 1);
            }

            $a = collect();
            $a->put('id', $val->id);
            $a->put('seller_id', $val->seller_id);
            $a->put('service_name', $val->service_name);
            $a->put('description', $val->description);
            $a->put('category_id', $val->category_id);
            $a->put('photo', $val->photo);
            $a->put('price', $val->price);
            $a->put('duration', $val->duration);
            $a->put('sold', $val->sold);
            $a->put('created_at', strval($val->created_at));
            $a->put('updated_at', $val->updated_at);
            $a->put('rating', $totalRating);

            $new->add($a);
        }

        $sorted = $new->sortByDesc('rating')->take(6);

        return view('pages.popularity', ['services' => $sorted]);
    }

    public function category()
    {
        $categories = Category::all();
        $services = Service::all();
        return view('pages.category', ['services' => $services, 'categories' => $categories]);
    }

    public function category2($category)
    {
        $categories = Category::all();
        $data = Category::where('category_name', $category)->first();

        if ($data) {
            $services = Service::where('category_id', $data->id)->get();
            return view('pages.category', ['services' => $services, 'categories' => $categories]);
        } else {
            return abort(404);
        }
    }

    public function history()
    {
        $history = Sale::with('order')->whereHas('order', function (Builder $query) {
            $query->where('buyer_id', Auth::user()->id);
        })->get();

        return view('pages.buyHistory', ["results" => $history]);
    }

    public function serviceList()
    {
        $services = Service::all();
        return view('pages.serviceList', ['services' => $services]);
    }

    public function search($search)
    {
        $categories = Category::all();
        $services = Service::select()->where('service_name', 'like', '%' . $search . '%')->get();
        return view('pages.category')->with(['services' => $services, 'categories' => $categories]);
    }

    public function sortLowPrice()
    {
        $categories = Category::all();
        $services = Service::orderBy('price', 'ASC')->get();
        return view('pages.category', ['services' => $services, 'categories' => $categories]);
    }

    public function sortHighPrice()
    {
        $categories = Category::all();
        $services = Service::orderBy('price', 'DESC')->get();
        return view('pages.category', ['services' => $services, 'categories' => $categories]);
    }

    public function notification()
    {
        $notifications = Auth::user()->unreadNotifications;

        return view('pages.notificationList', ['notifications' => $notifications]);
    }

    public function notifRead(Request $request)
    {
        Auth::user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

}
