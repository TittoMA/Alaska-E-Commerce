@extends('layouts.master')

@section('title', 'Profile |')

@section('content')
<div class="py-4" style="background-color: #eb5454">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex">
                    <div style="height: 150px; width: 150px; border-radius: 10px; overflow: hidden;">
                        <img style="height: 100%; width: 100%; object-fit: cover; object-position: center; background-color: gainsboro"
                            src="{{ asset('img/profile/'.(Auth::user()->photo_profile ?? 'default_profile.png')) }}"
                            alt="">
                    </div>

                    <div class="ms-4">
                        <h2 class="mb-1 text-white">{{ Auth::user()->name }}</h2>
                        <p class="text-white"><i class="bi bi-envelope-fill me-2"></i> {{ Auth::user()->email }}</p>
                        <h4><span class="badge bg-light text-dark">{{ Auth::user()->user_type }}</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 d-flex justify-content-md-end align-items-md-center">
                <a style="background-color: #9e1414" href="{{ route('profile.edit') }}" class="btn def-button"><i class="me-2 bi bi-pencil"></i>Edit
                    Profile </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
    <h4>Personal Information</h4>
    <hr width="100px" size="7px" />
    <div class="row">
        <div class="col-md-6">
            <div class="card br-card def-shadow mb-2">
                <div class="card-body">
                    <h6 style="font-size: 13pt"><i class="bi bi-person me-2"></i> Name</h6>
                    <p>{{ Auth::user()->name }}</p>
                    <h6 style="font-size: 13pt" class="mt-3"><i class="bi bi-envelope me-2"></i> Email Address </h6>
                    <p>{{ Auth::user()->email }}</p>
                    <h6 style="font-size: 13pt" class="mt-3"><i class="bi bi-telephone me-2"></i> Phone Number</h6>
                    <p class="mb-0">{{ Auth::user()->phone_number ?? "Not Filled"}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card br-card def-shadow mb-2">
                <div class="card-body">
                    <h6 style="font-size: 13pt"><i class="bi bi-house-door me-2"></i> Address</h6>
                    <p>{{ Auth::user()->address ?? "Not Filled" }}</p>
                    <h6 style="font-size: 13pt" class="mt-3"><i class="bi bi-gender-ambiguous me-2"></i> Gender</h6>
                    <p>{{ Auth::user()->gender ?? "Not Filled" }}</p>
                    <h6 style="font-size: 13pt" class="mt-3"><i class="bi bi-calendar-event me-2"></i> Birth Date</h6>
                    <p class="mb-0">{{ Auth::user()->birth_date ?? "Not Filled" }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection