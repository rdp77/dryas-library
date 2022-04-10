@extends('layouts.default')
@section('title', __('home.title'))
@section('content')
<section class="hero-section">
	<div class="hero-slider owl-carousel">
		<div class="hs-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="hs-text">
							<h2><span>@lang('home.booktitle1')</span>@lang('home.booktitlechild1')</h2>
							<p>{{ __('home.bookdesc1') }}</p>
							<a href="{{ route('pages.catalog') }}" class="site-btn">{{ __('home.catalog') }}</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="hr-img">
							<img src="{{ asset('assets/img/draw/undraw_book_lover_mkck.svg') }}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="hs-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="hs-text">
							<h2><span>@lang('home.booktitle2')</span>@lang('home.booktitlechild2')</h2>
							<p>@lang('home.bookdesc2')</p>
							@if (Auth::user() != null)
							<a href="{{ route('book-loan.index') }}" class="site-btn">{{ __('Borrow') }}</a>
							@else
							<a href="{{ route('login') }}" class="site-btn">{{ __('Borrow') }}</a>
							@endif
							<a href="{{ route('pages.catalog') }}" class="site-btn sb-c2">{{ __('home.catalog') }}</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="hr-img">
							<img src="{{ asset('assets/img/books/hero-bg.png') }}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="intro-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="section-title">
					<h2>{{ __('Unlimited Access to 100K books') }}</h2>
				</div>
			</div>
			<div class="col-lg-6">
				<p>@lang('home.desc')</p>
				@if (Auth::user() != null)
				<a href="{{ route('book-loan.index') }}" class="site-btn">@lang('home.try')</a>
				@else
				<a href="{{ route('login') }}" class="site-btn">@lang('home.try')</a>
				@endif
			</div>
		</div>
	</div>
</section>
<section class="how-section spad">
	<div class="container text-white">
		<div class="section-title">
			<h2>How it works</h2>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="how-item">
					<div class="hi-icon">
						<img src="{{ asset('assets/img/icons/brain.png') }}" alt="">
					</div>
					<h4>Create an account</h4>
					<p>Create an account faster without going to the library online, just making use of your internet
						connection and your device.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="how-item">
					<div class="hi-icon">
						<img src="{{ asset('assets/img/icons/pointer.png') }}" alt="">
					</div>
					<h4>Select a books</h4>
					<p>Choose the book you want, whatever it is, whenever it is, and wherever it is, you can do it
						easily.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="how-item">
					<div class="hi-icon">
						<img src="{{ asset('assets/img/icons/smartphone.png') }}" alt="">
					</div>
					<h4>Rent</h4>
					<p>Rent books that you like repeatedly even every day, up to 5 books in a row.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="concept-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="section-title">
					<h2>Best-seller Books</h2>
				</div>
			</div>
			<div class="col-lg-6">
				<p>We also have Best-seller books that are made by well-known journalists and are currently booming. All
					of these books are valid for the past 1 year, so you don't need to worry about this best-seller
					books data because this data is truly original based on user surveys.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<div class="concept-item">
					<img src="{{ asset('assets/img/books/1.jpg') }}" alt="">
					<h5>MOMENTUM</h5>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="concept-item">
					<img src="{{ asset('assets/img/books/2.jpg') }}" alt="">
					<h5>THE BOY</h5>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="concept-item">
					<img src="{{ asset('assets/img/books/3.jpg') }}" alt="">
					<h5>PATHWAY TO LOVE</h5>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="concept-item">
					<img src="{{ asset('assets/img/books/4.jpg') }}" alt="">
					<h5>CATCHER IN THE RYE</h5>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="subscription-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="sub-text">
					<h2>Features offered</h2>
					<h3>Try renting now</h3>
					<p>To satisfy readers in the Dryas Library we want to give some advantages to our library that are
						not in other libraries, or even yet. For that we want to show this feature as well as pamper you
						as a book enthusiast.</p>
					@if (Auth::user() != null)
					<a href="{{ route('book-loan.index') }}" class="site-btn">Try it now</a>
					@else
					<a href="{{ route('login') }}" class="site-btn">Try it now</a>
					@endif
				</div>
			</div>
			<div class="col-lg-6">
				<ul class="sub-list">
					<li><img src="{{ asset('assets/img/icons/check-icon') }}.png" alt="">Duration of Loans Up to 21 Days
					</li>
					<li><img src="{{ asset('assets/img/icons/check-icon') }}.png" alt="">Full access to reading online
					</li>
					<li><img src="{{ asset('assets/img/icons/check-icon') }}.png" alt="">Borrow Now Up to 5 books</li>
					<li><img src="{{ asset('assets/img/icons/check-icon') }}.png" alt="">Free Library Membership Card
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endsection