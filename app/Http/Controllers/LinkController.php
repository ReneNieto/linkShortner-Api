<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LinkController extends Controller
{

    public function index()
    {
        $auth = Auth::id();
        $links = Link::with('user', 'views')->where('user_id', $auth)->get()->all();
        return LinkResource::collection($links);
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'user_id' => ['required'],
                'link' => ['required'],

            ]
        );
        $data['shortlink'] = Str::random(6);
        $link = Link::create($data);
        $link->load('user');
        return LinkResource::make($link);
    }


    public function update(Request $request, Link $link)
    {
        $data = $request->validate(
            [
                'link' => ['required'],
            ]
        );
        $link->update($data);
        $link->load('user');

        return LinkResource::make($link);
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return response()->json(['message' => 'Link deleted successfully']);
    }

    public function redirectLink(Request $request, $url)
    {

        $link = Link::where('shortlink', $url)->first();
        Views::create(['link_id' => $link->id]);
        return redirect($link->link);
    }
}
