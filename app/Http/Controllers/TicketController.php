<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::where('user_id', $request->get('user_id'))->get();

        return $tickets;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

       

        if (request('images')) {
            $images = request('images')->store( 'public');
            

            $ticket =  Ticket::create([
                'user_id' => $request->get('user_id') ,
                'title' => $request->get('title') ,
                'content' => $request->get('content') ,
                'status' => $request->get('status') ,
                'images' => $images
            ]);
        }

        $ticket =  Ticket::create([
            'user_id' => $request->get('user_id') ,
            'title' => $request->get('title') ,
            'content' => $request->get('content') ,
            'status' => $request->get('status') ,
            
        ]);

        if (request('tags')) {

            foreach(request('tags') as $tag){

                $ticket->tags()->attach($tag->id);
            }
        }
        

        return 'ticket created';
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $ticket = Ticket::where('id', $request->get('id'))->first();

        return $ticket;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);        

    

        if (request('images')) {
            $images = request('images')->store('public');
            $imagesArray = ['image' => $images];
        }

        $ticket = Ticket::where('id', $request->get('id'))->first();
        $ticket->update(array_merge(
            $data,
            $imagesArray ?? []
        ));

        if (request('tags')) {

            foreach(request('tags') as $tag){

                $ticket->tags()->attach($tag->id);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ticket = Ticket::where('id', $request->get('id'))->first();

        $ticket->delete();
        return 'ticket deleted';
    }
}
