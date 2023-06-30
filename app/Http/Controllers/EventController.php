<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderByDesc('id')->get();
        //select * from reports (if in mysql command)
        return view('event.index', ['events'=> $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        return view ('event.create',['events'=> $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'type' => 'required',
            'status' => 'required',
            'link' => 'required',
        ]);
    
        try {
            $user = User::where('role', 'admin')->first();
            if ($user) {
                $event = new Event();
                $event->user_id = $user->id;
                $event->name = $request->name;
                $event->date = $request->date;
                $event->type = $request->type;
                $event->status = $request->status;
                $event->link = $request->link;
                $event->save();
            }
    
            return redirect()->route('event.create')->with('success', 'Event submitted successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('event.create')->with('fail', 'Failed to submit event.');
        }
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
        return view('event.show', ['events'=> $events]);
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
        return view ('event.edit') -> with (['event'=>$event]);
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
            
            'name'=>'required',
            'date'=>'required',
            'type'=>'required',
            'link'=>'required'
        ]);
        try{
        
        // $driver = User::where('id', $id)->where('role', 'driver')->first();
        // $driver->phone = $request->phone;
        // $driver->save();
        
        $event=Event::where('id', $id)->first();
        $event->name =$request->name;
        $event->date =$request->date;
        $event->type =$request->type;
        $event->link =$request->link;
        $event->save();

        return redirect()->route('event.index')
            ->with('success','Data updated successfully.');
    }
    catch(\Exception $e)
    {
        return redirect()->route('event.edit')->with ('fail','Data is not updated');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($event)
    {
        $event = Event::find($event);
        $event->delete();
        return redirect()->route('event.index')->with ('success','Event data is deleted.');
    }
  
    public function generatePdf()
    {
        $events = Event::all();
           // Generate the PDF using the Laravel PDF library
        $dompdf =  new Dompdf();
        $tableHtml = View::make ('event.generatePdf',compact ('events'))->render();
        $html='<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>AC10 Event</title>
            <style>
               thead {
                        background-color: #808BF1;
               }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 5px;
                }
            </style>
        </head>
        <body>
            <h1>Report AC10 Event</h1>
            ' . $tableHtml . '
        </body>
        </html>';
        $dompdf->loadHtml($html);

        $options = New Options();
        $options->set('defaultFont','Arial');
        $dompdf->setOptions($options);

        $dompdf->render();
        $dompdf->stream('Report AC10 Event.pdf');
    
    }
}
