@extends('layouts.frontend.default')
@section('title', __('team.title'))
@section('content')
<section class="premium-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">
                    <h2>@lang('team.titlesection')</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <p>@lang('team.desc')</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="premium-item">
                    <img src="{{ asset('assets/img/avatar/rdp77.png') }}" alt="">
                    <h4>{{ __('Moh Ravi Dwi Putra') }}</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="premium-item">
                    <img src="{{ asset('assets/img/avatar/axl.jpg') }}" alt="">
                    <h4>{{ __('Deny Prasetyo') }}</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="premium-item">
                    <img src="{{ asset('assets/img/avatar/default.svg') }}" alt="">
                    <h4>{{ __('Abdul Rozaq N') }}</h4>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="premium-item">
                    <img src="{{ asset('assets/img/avatar/ah.jpg') }}" alt="">
                    <h4>{{ __('Abdurrahman Hanif') }}</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="premium-item">
                    <img src="{{ asset('assets/img/avatar/default.svg') }}" alt="">
                    <h4>{{ __('Ahmad Rizal M') }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection