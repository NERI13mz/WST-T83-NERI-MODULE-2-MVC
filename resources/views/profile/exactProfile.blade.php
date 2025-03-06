<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
@extends('layouts.dashboardTemp')
@section('content')
@section('title', 'Profile')
@section('Pages')
    <span style="font-weight: 500;">Profile</span>
@endsection
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Student ID</label>
                        <input type="text" class="form-control" disabled value="{{ Auth::user()->student_id }}">
                      </div>
                    </div>
                    <div class="col-md-7 pl-1">
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email', Auth::user()->email) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                               name="address" value="{{ old('address', Auth::user()->address) }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" class="form-control @error('about') is-invalid @enderror" 
                                  name="about">{{ old('about', Auth::user()->about) }}</textarea>
                        @error('about')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary">Update Profile</button>
                      @if(session('success'))
                          <div class="alert alert-success mt-3">
                              {{ session('success') }}
                          </div>
                      @endif
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/bg5.jpg" alt="Background Image">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="{{ route('profile.show') }}" class="profile-link">
                    <img class="avatar border-gray" src="../assets/img/mike.jpg" alt="Profile Image">
                    <h5 class="title">{{ Auth::user()->name }}</h5>
                  </a>
                  <p class="description">
                    {{ Auth::user()->student_id }}
                  </p>
                </div>
                <p class="description text-center">
                  {{ Auth::user()->about ?? "No description available" }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

<style>
    .card-user .author a.profile-link {
        color: var(--navy-blue);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .card-user .author a.profile-link:hover {
        color: var(--gold);
    }

    .card-user .author .avatar {
        width: 124px;
        height: 124px;
        border: 3px solid var(--gold);
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .card-user .author a.profile-link:hover .avatar {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-primary {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold) !important;
        color: var(--gold) !important;
        transition: all 0.3s ease;
        padding: 0.5rem 1.5rem;
    }

    .btn-primary:hover {
        background: var(--gold) !important;
        color: var(--navy-blue) !important;
        transform: translateY(-2px);
    }

    .form-control {
        border: 1px solid var(--gold);
        color: var(--navy-blue);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    }

    .card-header {
        background: var(--navy-blue) !important;
        color: var(--white);
    }

    .card-header .title {
        color: var(--white);
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .alert {
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
</style>
@endsection