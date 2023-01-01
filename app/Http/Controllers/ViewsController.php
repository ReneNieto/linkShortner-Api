<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewsController extends Controller
{

    public function index()
    {
        //
    }

    public function store($link)
    {
        $uri = Link::where('shortlink', $link)->first();
        Views::create([
            'link_id' => $uri->id,
        ]);
        return redirect($uri->link);
    }

    public function views()
    {

        $views = Views::whereRelation('link', 'user_id', Auth::id())
            ->selectRaw('monthname(created_at) as month, count(*) as views')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $views;
    }
}
