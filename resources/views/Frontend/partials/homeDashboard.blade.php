@extends('Frontend.master')

@section('content')

<!-- Hero Section -->
<div class="item">
    <div class="slider-img">
        <img src="{{ asset('assets/image/service 9.jpg') }}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="slider-captions">
                    <h1 class="slider-title fw-bold text-white">Revolutionizing Employee Management</h1>
                    <p class="text-dark text-white">Streamlining workforce operations with cutting-edge HR solutions and innovative management strategies.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services -->
<div class="space-medium bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h2>Our Comprehensive HR Services</h2>
                    <a href="{{ route('services') }}">Explore All Services</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Service Blocks -->
            @foreach ($services->take(4) as $item)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="service-block">
                    <div class="service-img"><img src="{{ url('/uploads/' . $item->service_image) }}" alt="{{ $item->service_name }}"></div>
                    <div class="service-content">
                        <h3 class="service-title"><a href="{{ route('services.details', $item->id) }}" class="title">{{ $item->service_name }}</a></h3>
                        <p>{{ $item->description }}</p>
                        <a href="{{ route('services.details', $item->id) }}">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /.Service Blocks -->
        </div>
        <div class="row hidden-service-cards" style="display: none;">
            <!-- Hidden Service Cards -->
            @foreach ($services->slice(4) as $item)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-card">
                <div class="service-block">
                    <div class="service-img"><img src="{{ url('/uploads/' . $item->service_image) }}" alt="{{ $item->service_name }}"></div>
                    <div class="service-content">
                        <h3 class="service-title"><a href="{{ route('services.details', $item->id) }}" class="title">{{ $item->service_name }}</a></h3>
                        <p>{{ $item->description }}</p>
                        <a href="{{ route('services.details', $item->id) }}">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- /.Services -->

<!-- Features Section -->
<div class="space-medium">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h2>Why Our Solutions Stand Out</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Feature Blocks -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="feature-center line">
                    <div class="feature-icon">
                        <i class="fa-solid fa-briefcase fa-xl"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Leading-Edge Solutions</h3>
                        <p>Driving efficiency and excellence with advanced HR technology and best practices in the industry.</p>
                    </div>
                </div>
            </div>
            <!-- /.Feature Block -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="feature-center line">
                    <div class="feature-icon">
                        <i class="fa-solid fa-thumbs-up fa-xl"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Core Values and Mission</h3>
                        <p>Our mission is to foster a culture of integrity, innovation, and inclusivity to drive organizational success.</p>
                    </div>
                </div>
            </div>
            <!-- /.Feature Block -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="feature-center">
                    <div class="feature-icon">
                        <i class="fa-solid fa-people-group fa-xl"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Commitment to Employee Well-being</h3>
                        <p>Creating a positive work environment that supports personal growth, work-life balance, and overall satisfaction.</p>
                    </div>
                </div>
            </div>
            <!-- /.Feature Block -->
        </div>
    </div>
</div>

<!-- Client Testimonials -->
<div class="space-medium">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h2>Our Clients' Success Stories</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Client Logos -->
            @foreach ($clients as $item)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="client-block">
                    <div class="client-head">
                        <a href="#"><img src="{{ url('/uploads/' . $item->client_image) }}" alt="{{ $item->client_name }}"></a>
                    </div>
                    <div class="client-content">
                        <h4><a href="#">{{ $item->client_name }}</a></h4>
                        <p>{{ $item->details }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
    </div>
</div>

@endsection
