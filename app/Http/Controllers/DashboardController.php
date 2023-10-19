<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Artists;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $songs = Artists::join('albums', 'artists.id', '=', 'albums.id')
            ->select(
                'artists.id',
                'artists.name as artist',
                'albums.name as album',
                'code',
                'cover',
                'sales',
                'year',
            )
            ->get();

        // return $songs->toJson();

        return Inertia::render(
            'Dashboard',
            [
                'songs' => $songs
            ]
        );
    }

    public function sales()
    {

        $songs = Artists::join('albums', 'artists.id', '=', 'albums.id')
            ->select('artists.name as artist', DB::raw('SUM(albums.sales) as sales'))
            ->groupBy('artist')
            ->get();

        //return $songs->toJson();

        return Inertia::render(
            'Dashboard',
            [
                'songs' => $songs
            ]
        );
    }

    public function top1()
    {
        $songs = Artists::join('albums', 'artists.id', '=', 'albums.id')
            ->select('artists.name as artist', DB::raw('SUM(albums.sales) as sales'))
            ->groupBy('artist')
            ->orderBy('sales', 'desc')
            ->limit(1)
            ->get();

        // return $songs->toJson();

        return Inertia::render(
            'Dashboard',
            [
                'songs' => $songs
            ]
        );
    }

    public function search(Request $request)
    {

        $search = $request->input('search_artist');

        $songs = Artists::join('albums', 'artists.id', '=', 'albums.id')
            ->select(
                'artists.id',
                'artists.name as artist',
                'albums.name as album',
                'code',
                'cover',
                'sales',
                'year'
            )
            ->where('artists.name', 'like', '%' . $search . '%')
            ->get();


        // return $songs->toJson();

        return Inertia::render(
            'Dashboard',
            [
                'songs' => $songs
            ]
        );
    }
}
