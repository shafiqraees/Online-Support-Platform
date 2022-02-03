<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketDatatable extends Component
{
    use WithPagination;

    public $search = '';
    public $per_page = 10;

    public $name;
    public $email;
    public $phone_number;
    public $status;

    protected $paginationTheme = 'bootstrap';
    public function resetFilters() {
        $this->reset(['name', 'email', 'phone_number', 'status']);
    }

    public function search()
    {
        // just to make update of table with button.
    }
    public function render()
    {
        $data = SupportTicket::query();

        if ($this->status != '') {
            $data = $data->where('status', trim(strtoupper($this->status)));
        }

        if ($this->name != '') {
            $data = $data->whereHas('customer' , function ($query) {
                 $query->where('name', 'like', "%$this->name%");
            });
        }
        if ($this->email != '') {
            $data = $data->whereHas('customer' , function ($query) {
                 $query->where('email', 'like', "%$this->email%");
            });
        }
        if ($this->phone_number != '') {
            $data = $data->whereHas('customer' , function ($query) {
                 $query->where('email', 'like', "%$this->phone_number%");
            });
        }
        $data = $data->with('customer')->orderBy('id', 'desc')->paginate($this->per_page);
        return view('livewire.ticket-datatable',compact('data'));
    }

}
