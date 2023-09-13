<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::where('user_id', $request->get('user_id'))->where('ticket_id', $request->get('ticket_id'))->get();

        return $comments;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'ticket_id' => 'required',
        ]);


        if (request('images')) {
            $images = request('images')->store('public');
            
            $comment =  Comment::create([
                'text' => $request->get('text') ,
                'ticket_id' => $request->get('ticket_id') ,
                'images' => $request->get('images')
            ]);
        }

        $comment =  Comment::create([
            'text' => $request->get('text') ,
            'ticket_id' => $request->get('ticket_id') ,
            
        ]);

        return 'comment created';
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $comment = Comment::where('id', $request->get('id'))->first();

        return $comment;
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $data = request()->validate([
            'text' => 'required',
            'ticket_id' => 'required',
        ]);        

    

        if (request('images')) {
            $images = request('images')->store('public');
            $imagesArray = ['image' => $images];
        }

        $comment = Comment::where('id', $request->get('id'))->first();
        $comment->update(array_merge(
            $data,
            $imagesArray ?? []
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $comment = Comment::where('id', $request->get('id'))->first();

        $comment->delete();
        return 'comment deleted';
    }
}
