@extends('layouts.frontend.default')
@section('title', __('about.title'))
@section('content')
<section class="premium-section spad">
    <div class="container">
        <div class="section-title">
            <h2>About</h2>
        </div>
        <section class="songs-details-section">
            <div class="container-fluid">
                <div class="song-details-box">
                    <p class="mb-3">
                    <h3>Specification</h3>
                    <ul>
                        <li><strong>DBMS:</strong><span>PostGreSQL</span></li>
                        <li><strong>Visual Canvas:</strong><span>Creately</span></li>
                        <li><strong>Web UI Mockup Tools:</strong><span>Protopie</span></li>
                    </ul>
                    </p>
                </div>
                <div class="song-details-box">
                    <h3>Provisions</h3>
                    <p class="text-justify">
                        @lang('about.provisiondesc1')
                    </p>
                    <p class="text-justify">
                        @lang('about.provisiondesc2')
                    </p>
                    <p class="text-justify">
                        @lang('about.provisiondesc3')
                    </p>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection