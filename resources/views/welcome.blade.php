@extends('layouts.app')

@push('style')
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background: gray; color:#f1f7fa; font-weight:bold;">
                            Hi {{ Auth::user()->name }}
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            <h5>Your Email: {{ Auth::user()->email }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
