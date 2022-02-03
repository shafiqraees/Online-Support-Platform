<?php

namespace App\Repositories\Contracts;

use App\Models\SupportTicket;
use App\Models\TicketRespons;
use App\Models\User;

interface TicketRepositoryContract{

    public function updateStatus($packet,SupportTicket $ticket): ? SupportTicket;

    public function createOrUpdateUser($packet): ? User;

    public function ResolveTicket($packet,SupportTicket $ticket): ? TicketRespons;

    public function StoreTicket($packet): ? SupportTicket;

}
