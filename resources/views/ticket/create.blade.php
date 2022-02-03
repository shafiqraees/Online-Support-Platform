@extends('layouts.app')
@section('content')
    <div class="container">

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Online Support Platform</h2>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Generate Ticket</h3>
                            <form action="{{route('ticket.store')}}" method="post" class="signin-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" name="email" class="form-control" placeholder="email" required>
                                </div>
                                <div class="form-group">
                                    <input id="phone_number" type="tel" name="phone_number" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Problem Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                                </div>
                            </form>
                            <p class="w-100 text-center"></p>
                            <div class="social d-flex text-center">
                                <a href="{{route('check.status')}}" class="px-2 py-2 mr-md-1 rounded"> Check Status</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('style')
    <style>
        #app {
            background-image: url({{ URL::asset('assets/images/bg.jpg')}});
        }
    </style>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
@endsection
