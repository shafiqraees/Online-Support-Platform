<?php

namespace App\Repositories;

use App\Jobs\Aknowlegment;
use App\Jobs\TicketResolveJob;
use App\Models\SupportTicket;
use App\Models\TicketRespons;
use App\Models\User;
use App\Repositories\Contracts\TicketRepositoryContract;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketRepository implements TicketRepositoryContract
{

    public function updateStatus($packet,SupportTicket $ticket): ? SupportTicket
    {
        try {

            DB::transaction(function () use ($packet, $ticket) {
                $ticket->user_id = auth()->user()->id;
                $ticket->status = isset($packet['status']) ? $packet['status'] : SupportTicket::STATUS_PROCESSING;
                $ticket->save();
                dispatch(new TicketResolveJob($ticket,$packet));
            });
            return $ticket;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createOrUpdateUser($packet): ? User
    {
        try {
            return User::updateOrCreate(
                ['email' => $packet['email']],
                ['name' => $packet['email'], 'phone_number' => $packet['email']]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function ResolveTicket($packet,SupportTicket $ticket): ? TicketRespons
    {
        try {
            $model = new TicketRespons;
            DB::transaction(function () use ($packet, $ticket,$model) {
                $this->updateStatus($packet,$ticket);
                $model->support_ticket_id = $ticket->id;
                $model->user_id = auth()->user()->id;
                $model->description = isset($packet['description'])? $packet['description'] : null;
                $model->save();
            });
            dispatch(new TicketResolveJob($ticket,$packet));
            return $model;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function StoreTicket($packet): ? SupportTicket
    {
        try {
            $ticket = new SupportTicket();
            DB::transaction(function () use ($packet, $ticket) {
                $user = $this->createOrUpdateUser($packet);
                $ticket->ticket_number = Str::orderedUuid();;
                $ticket->customer_id = $user->id;
                $ticket->problem_description = isset($packet['description'])? $packet['description'] : null;
                $ticket->save();
                dispatch(new Aknowlegment($ticket));
            });
            return $ticket;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTicketById(int $id) : ? SupportTicket{
        try{
            return SupportTicket::find($id);
        }
        catch(Exception $e){
            throw $e;
        }
    }

}
