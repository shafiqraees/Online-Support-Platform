@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col">
            @isset($search_query)
                @livewire('ticket-datatable',['search' => $search_term])
            @else
                @livewire('ticket-datatable')
            @endisset
        </div>
    </div>
</div>
@endsection
