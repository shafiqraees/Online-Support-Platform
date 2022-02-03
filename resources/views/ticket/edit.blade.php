@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card overflow-hidden">
                <div class="card-header d-flex flex-between-center bg-light py-2">
                    <h6 class="mb-0">Resolve Ticket</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('tickets.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label" for="inputStatus">Status</label>
                            <select class="form-select" aria-placeholder="Choose Status" name="status" id="inputStatus" required>
                                <option value="PENDING" @if($data->status=='PENDING')selected @endif>Pending</option>
                                <option value="PROCESSING" @if($data->status=='PROCESSING')selected @endif>Processing</option>
                                <option value="CANCELLED" @if($data->status=='CANCELLED')selected @endif>Cancelled</option>
                                <option value="COMPLETED" @if($data->status=='COMPLETED')selected @endif>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputName">Description</label>
                            <textarea  class="form-control @error('name') is-invalid @enderror" name="description" required placeholder="Decription here" > </textarea>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Provide valid name</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Resolve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
