<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Albums::get();

        // return $artists->toJson();

        return Inertia::render(
            'Album/View',
            [
                'albums' => $result
            ]
        );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function show(Albums $albums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function edit(Albums $albums, $id)
    {
        $result = $albums->where('id', $id)->get();

        // return $artist->toJson();

        return Inertia::render(
            'Album/Edit',
            [
                'album' => $result
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'year' => 'required',
            'name' => 'required',
            'sales' => 'required',
        ]);

        $album = Albums::find($id);
        $album->year = $request->input('year');
        $album->name = $request->input('name');
        $album->sales = $request->input('sales');

        if ($request->hasFile('cover')) {

            $image = $request->file('cover');
            $publicPath = public_path('images');
            $imagePath = $publicPath . '/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($publicPath, $imagePath);
            $album->cover = basename($imagePath);
        }

        $album->save();

        return redirect()->route('albums')->with('success', 'Album Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Albums::find($id);
        $artist->delete();

        return redirect()->route('albums')->with('success', 'Artist Deleted Successfully');
    }
}
