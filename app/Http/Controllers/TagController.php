<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return $tags;
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $comment =  Tag::create([
            'name' => $request->get('name') 
        ]);

        return 'tag created';
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tag = Tag::where('id', $request->get('id'))->first();

        return $tag;
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = request()->validate([
            'name' => 'required', 
        ]);        

        $tag = Tag::where('id', $request->get('id'))->first();


        $tag->update($data);

        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $tag = Tag::where('id', $request->get('id'))->first();

        $tag->delete();
        return 'tag deleted';
    }
}
