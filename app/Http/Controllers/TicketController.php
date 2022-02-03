<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorSupportTicket;
use App\Models\SupportTicket;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorSupportTicket $request, TicketRepository $ticket)
    {
        $form_collect = $request->validated();
        try {
            $ticket->StoreTicket($form_collect);
            return redirect()->route('ticket.create')->with('success', 'Support Ticket Created Successfully');
        }  catch (Throwable $e) {
            throw $e;
            return redirect()->back()->with('error', 'Error While Support Ticket Creating');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkStatus()
    {
        return view('ticket.check_status');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ticketStaus(Request $request)
    {
        try {
            $status = SupportTicket::whereTicketNumber($request->name)->firstOrFail();
            if ($status) {
                return redirect()->route('check.status')->with('success', 'Your Quesry Status is : '.Str::title($status->status));
            }
            return redirect()->back()->with('error', 'Please provide correct token');
        }  catch (Throwable $e) {
            throw $e;
            return redirect()->back()->with('error', 'Error While Support Ticket Creating');
        }

    }
}
