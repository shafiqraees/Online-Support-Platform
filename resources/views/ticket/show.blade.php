
<div class="row">
    <div class="col">

        <div class="card mb-3">
            <div class="card-header" style="z-index:2;">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Details</h5>
                    </div>
                    <div class="col-auto">
                    <a href="{{ route('tickets.edit', $data->id) }}">
                        <button class="btn p-0 " type="button">
                            <span class="text-500 far fa-eye">Resolve Ticket</span>
                        </button>
                    </a>
                    </div>
                </div>
            </div>

            <div class="card-body position-relative">
                <h5>Ticket No: {{ $data->ticket_number  }}
                </h5>

                <p class="fs--1">@isset($data->created_at)
                        Ticket No:   {{ $data->created_at->format('F j, Y, g:i a') }}
                    @else
                        Ticket No:   April 21, 2019, 5:33 PM
                    @endisset</p>
                <div><strong class="me-2">Ticket Description: </strong>
                    {{ $data->problem_description  }}
                </div>


                <div><strong class="me-2">Status: </strong>
                    @if ($data->status == 'COMPLETED')
                        Completed
                    @elseif($data->status == 'PENDING')
                        Pending
                    @elseif($data->status == 'CANCELLED')
                        Cancelled
                    @elseif($data->status == 'PROCESSING')
                        Processing
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade bd-example-modal-lg addModal" id="addModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Resolve Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
{{-- edit payment method modal --}}

