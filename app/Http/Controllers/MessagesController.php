<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use App\Events\MessageWasReceived;
use App\Mail\ContactNotification;
use Mail;

class MessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()

    {
        $this->middleware('auth', ['except' =>[ 'create', 'store']]);
    }

    public function index()
    {
        // $messages = DB::table('messages')->get();
        $messages = Message::all();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        //$data = $request->all();
        $msg = new Message();
        $msg->name = $request->name;
        $msg->email = $request->email;
        $msg->message = $request->message;
        $msg->save();

        // $message = Message::create($request->all());

        Mail::to('info@luefty.com')->send(new ContactNotification($msg));

        return redirect('contact-us')->with('info', '<strong>' . __('Thank you') . ' ' . $request->input('name') . '. ' . '</strong>' . __('We will get in touch with you soon.') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Message::findOrFail($id)->update($request->all());

        return redirect()->route('messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrFail($id)->delete();

        return redirect()->route('messages.index');
    }
}
