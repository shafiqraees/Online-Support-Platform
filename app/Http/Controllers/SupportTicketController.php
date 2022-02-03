<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorSupportTicket;
use App\Http\Requests\UpdateTicket;
use App\Jobs\TicketResolveJob;
use App\Models\SupportTicket;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class SupportTicketController extends Controller
{
    protected $ticket;
    public function __construct(TicketRepository $ticket){
        $this->ticketRepo = $ticket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
    public function store(StorSupportTicket $request)
    {
        $form_collect = $request->validated();
        try {
            $this->ticketRepo->StoreTicket($form_collect);
            return redirect()->route('tickets.index')->with('success', 'Support Ticket Created Successfully');
        }  catch (Throwable $e) {
            throw $e;
            return redirect()->back()->with('error', 'Error While Support Ticket Creating');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data =  $this->ticketRepo->getTicketById($id);
        $packet = [];
        $this->ticketRepo->updateStatus($packet,$data);
        return view('ticket.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  $this->ticketRepo->getTicketById($id);
        return view('ticket.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicket $request,$id)
    {
        $form_collect = $request->validated();
        try {
            $data =  $this->ticketRepo->getTicketById($id);
            $this->ticketRepo->ResolveTicket($form_collect,$data);
            return redirect()->route('tickets.index')->with('success', 'Support Ticket Created Successfully');
        }  catch (Throwable $e) {
            throw $e;
            return redirect()->back()->with('error', 'Error While Support Ticket Creating');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }
}
