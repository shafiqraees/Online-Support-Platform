<div class="card overflow-hidden">
    <div class="card-header d-flex flex-between-center bg-light py-2">
        <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Tickets</h5>
        </div>

    </div>
    @if ($message = session()->has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->get('success') }}
        </div>
    @endif
    @if ($message = session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('errors') }}
        </div>
    @endif
    <div class="card-body py-0">
        <div class="collapse show" id="collapseExample" wire:ignore.self>
            <div class="border p-card rounded">
                {{-- <form method="get" action="{{route('orders.filter') }}"> --}}
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="name">Name</label>
                        <input class=" form-control" wire:model.defer="name" placeholder="Name of Customer" />
                    </div>
                    <div class="col">
                        <label class="form-label" for="email">Email</label>
                        <input class=" form-control" wire:model.defer="email" placeholder="Email of Customer" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" wire:model.defer="status" name="status" aria-label="Default select example">
                            <option selected="" value="null" selected>Select Status</option>
                            <option value="PENDING">Pending</option>
                            <option value="PROCESSING">Processing</option>
                            <option value="CANCELLED">Cancelled</option>
                            <option value="COMPLETED">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button class="btn btn-primary search" id="search" wire:click="search">Search</button>
                        <button class="btn btn-secondary" wire:click="resetFilters">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-warning border-2 d-flex align-items-center" role="alert">
                <div class="bg-warning me-3 icon-item"><span class="fas fa-cross-circle text-white fs-3"></span></div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><p class="mb-0 flex-1">{{ $error }}</p></li>
                    @endforeach
                </ul>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="table-responsive scrollbar">
            <table class="table table-hover table-striped overflow-hidden">
                <thead>
                <tr>
                    <th scope="col" class=" text-nowrap">Id</th>
                    <th scope="col" class=" text-nowrap">Customer Name</th>
                    <th scope="col" class=" text-nowrap">Email</th>
                    <th scope="col" class=" text-nowrap">Phone Number</th>
                    <th scope="col" class=" text-nowrap">Problem Description</th>
                    <th scope="col" class=" text-nowrap">Status</th>
                    <th class="text-end text-nowrap" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $ticket)
                        <tr class="align-middle @if ($ticket->status == strtoupper('pending')) alert-danger @endif">
                            <td class="text-nowrap">
                                {{$ticket->id}}
                            </td>
                            <td class="text-nowrap">
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">{{ isset($ticket->customer->name) ? $ticket->customer->name : null }}</div>
                                </div>
                            </td>
                            <td class="text-nowrap">{{ isset($ticket->customer->email) ? $ticket->customer->email : null }}</td>
                            <td class="text-nowrap">
                                {{ isset($ticket->customer->phone_number) ? $ticket->customer->phone_number : null }}
                            </td>
                            <td class="text-nowrap">
                                {{ isset($ticket->problem_description) ? $ticket->problem_description : null }}
                            </td>
                            <td class="text-nowrap">
                                @if ($ticket->status == strtoupper('pending'))
                                    <span class="badge badge rounded-pill d-block p-2 badge-soft-success">
                                                Pending
                                                <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                            </span>
                                @elseif($ticket->status == strtoupper('processing'))
                                    <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">
                                                Inactive<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span>
                                            </span>
                                @elseif($ticket->status == strtoupper('cancelled'))
                                    <span class="badge rounded-pill d-block p-2 badge-soft-danger">Blocked
                                                <span class="ms-1 far fa-times-circle" data-fa-transform="shrink-2"></span>
                                            </span>
                                @elseif($ticket->status == strtoupper('completed'))
                                    <span class="badge badge rounded-pill d-block p-2 badge-soft-success">
                                                Completed
                                                <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                            </span>
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                <div>
                                    <a href="javascript:void(0)"
                                       data-action="{{ route('tickets.show', $ticket->id) }}"
                                       data-toggle="modal" data-target="#addModal"
                                       data-text="Ticket Detail"
                                       class="no-underline-on-hover ticket-view">
                                        <button class="btn p-0 " type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="" data-bs-original-title="Ticket Detail"
                                                aria-label="Edit">
                                            <span class="text-500 far fa-eye">View</span>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class=" align-middle">
                        <td colspan="7">
                            <div class="alert alert-light" role="alert">No Ticket Found</div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-light py-2">
        <div class="row flex-between-center">
            @if ($data->count() > 0)
                <div class="col">
                    {!! $data->withQueryString()->links() !!}
                </div>
                <div class="col">
                    <p class="mb-0 fs--1 d-flex flex-row-reverse">
                        <span class="d-none d-sm-inline-block" data-list-info="data-list-info">Total Merchants {{$data->total()}}</span>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg addModal" id="addModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ticket Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
