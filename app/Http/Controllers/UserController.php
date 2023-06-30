<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $users = User::get();
        $events = Event::orderByDesc('id')->get();
        //select * from reports (if in mysql command)
        return view('user.dashboard', ['users'=> $users] , ['events'=> $events]);
    }

    public function viewReport()
    {
        $events = Event::orderByDesc('id')->get();
        //select * from event (if in mysql command)
        return view('user.viewReport', ['events' => $events]);
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $events)
    {
        $events = Event::orderByDesc('id')->get();
        //select * from reports (if in mysql command)
        return view('user.show', ['events'=> $events]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id',$id)->first();
        return view ('user.edit') -> with (['event'=>$event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'status'=>'required'
        ]);
        try{
        
        // $driver = User::where('id', $id)->where('role', 'driver')->first();
        // $driver->phone = $request->phone;
        // $driver->save();
        
        $event=Event::where('id', $id)->first();
        $event->status =$request->status;
        $event->save();

        return redirect()->route('user.dashboard')
            ->with('success','Data updated successfully.');
    }
    catch(\Exception $e)
    {
        return redirect()->route('user.dashboard')->with ('fail','Data is not updated');
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}