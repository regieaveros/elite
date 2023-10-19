<?php

namespace App\Http\Controllers;

use App\Models\Artists;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Artists::get();

        // return $artists->toJson();

        return Inertia::render(
            'Artist/View',
            [
                'artists' => $result
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
     * @param  \App\Models\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function show(Artists $artists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function edit(Artists $artists, $id)
    {
        $result = $artists->where('id', $id)->get();

        // return $artist->toJson();

        return Inertia::render(
            'Artist/Edit',
            [
                'artist' => $result
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $artist = Artists::find($id);
        $artist->name = $request->input('name');
        $artist->code = $request->input('code');
        $artist->save();

        return redirect()->route('artists')->with('success', 'Artist Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Artists::find($id);
        $artist->delete();

        return redirect()->route('artists')->with('success', 'Artist Deleted Successfully');
    }
}
