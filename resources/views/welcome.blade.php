@extends('WebSite.layouts.master')

@section('content')
    <!-- Main Slider Three -->
    <section class="main-slider-three">
        <div class="banner-carousel">
            <!-- Swiper -->
            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <div class="auto-container">
                        <div class="row clearfix">
                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h2>{{ trans('website/welcome.health_partner') }}</h2>
                                    <div class="btn-box">
                                        <a href="{{ route('ShowDoctorTable') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.appointments') }}</span></a>
                                        <a href="{{ route('ShowServices') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.services') }}</span></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="{{ URL::asset('WebSite/images/d.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="swiper-slide slide">
                    <div class="auto-container">
                        <div class="row clearfix">

                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h2>{{ trans('website/welcome.health_partner') }}</h2>
                                    <div class="btn-box">
                                        <a href="{{ route('ShowDoctorTable') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.appointments') }}</span></a>
                                        <a href="{{ route('ShowServices') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.services') }}</span></a>
                                    </div>

                                </div>
                            </div>

                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="{{ URL::asset('WebSite/images/d.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="swiper-slide slide">
                    <div class="auto-container">
                        <div class="row clearfix">

                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h2>{{ trans('website/welcome.health_partner') }}</h2>
                                    <div class="btn-box">
                                        <a href="{{ route('ShowDoctorTable') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.appointments') }}</span></a>
                                        <a href="{{ route('ShowServices') }}" class="theme-btn appointment-btn"><span
                                                class="txt">{{ trans('website/welcome.services') }}</span></a>
                                    </div>

                                </div>
                            </div>


                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="{{ URL::asset('WebSite/images/d.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- End Main Slider -->

    <!-- Health Section -->
    <section class="health-section">
        <div class="auto-container">
            <div class="inner-container">

                <div class="row clearfix">

                    <!-- Content Column -->
                    <div class="content-column col-lg-7 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="border-line"></div>
                            <!-- Sec Title -->
                            <div class="sec-title">
                                <h2> {{ trans('website/welcome.leadership') }}</h2>
                                <div class="separator"></div>
                            </div>
                            <div class="text">{{ trans('website/welcome.our_mission') }}
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="{{ URL::asset('WebSite/images/doctors.jpg') }}" height="42" width="42"
                                    alt="" />
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Health Section -->

    <!-- Featured Section -->
    <section class="featured-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon flaticon-doctor-stethoscope"></div>
                            <h3> {{ trans('website/welcome.medical_treatment') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon flaticon-ambulance-side-view"></div>
                            <h3> {{ trans('website/welcome.emergency_help') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon fas fa-user-md"></div>
                            <h3> {{ trans('website/welcome.qualified_doctors') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon fas fa-briefcase-medical"></div>
                            <h3> {{ trans('website/welcome.medical_professional') }}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Featured Section -->

    <!-- Department Section Three -->
    <section class="department-section-three">
        <div class="image-layer" style="background-image:url(images/background/6.jpg)"></div>
        <div class="auto-container">
            <!-- Department Tabs-->
            <div class="department-tabs tabs-box">
                <div class="row clearfix">
                    <!--Column-->
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <!-- Sec Title -->
                        <div class="sec-title light">
                            <h2>{{ trans('website/welcome.sections') }}</h2>
                            <div class="separator"></div>
                        </div>
                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#women" class="tab-btn active-btn">
                                {{ trans('website/welcome.women_section') }}</li>
                            <li data-tab="#surgery" class="tab-btn">{{ trans('website/welcome.surgery') }} </li>
                            <li data-tab="#kids" class="tab-btn"> {{ trans('website/welcome.children') }} </li>
                            <li data-tab="#brain" class="tab-btn">{{ trans('website/welcome.neurology') }} </li>
                            <li data-tab="#belly" class="tab-btn">{{ trans('website/welcome.internal_medicine') }} </li>
                            <li data-tab="#eye" class="tab-btn">{{ trans('website/welcome.ophthalmology') }} </li>

                        </ul>
                    </div>
                    <!--Column-->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <!--Tabs Container-->
                        <div class="tabs-content">
                            <div class="swiper-wrapper">

                                <!-- Tab -->
                                <div class="tab" id="women">
                                    <div class="content">
                                        <h2> {{ trans('website/welcome.women_section') }}</h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 1)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="surgery">
                                    <div class="content">
                                        <h2> {{ trans('website/welcome.surgery') }}</h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 2)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab active-tab" id="kids">

                                    <div class="content">
                                        <h2> {{ trans('website/welcome.children') }} </h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 3)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="brain">
                                    <div class="content">
                                        <h2>{{ trans('website/welcome.neurology') }}</h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 4)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="belly">
                                    <div class="content">
                                        <h2> {{ trans('website/welcome.internal_medicine') }}</h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 5)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="eye">
                                    <div class="content">
                                        <h2>{{ trans('website/welcome.ophthalmology') }}</h2>
                                        <h3>
                                            {{ trans('website/welcome.we') }}
                                        </h3>
                                        <div class="two-column row clearfix">
                                            @foreach (\App\Models\Doctor::where('section_id', 6)->get() as $doctor)
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <a class="theme-btn btn-style-two"><span
                                                            class="txt">{{ $doctor->name }}
                                                        </span></a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Department Section -->

    <!-- Team Section -->
    <section class="team-section">
        <div class="auto-container">

        </div>
    </section>
    <!-- End Team Section -->



    <!-- Appointment Section Two -->
    <section class="appointment-section-two">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="images/resource/doctor-2.png" alt="" />
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="form-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!-- Sec Title -->
                            <div class="sec-title">
                                <h2>{{ trans('website/appointments.book') }}</h2>
                                <div class="separator"></div>
                            </div>

                            <!-- Appointment Form -->
                            <div class="appointment-form">
                                <livewire:appointments.create />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section Two -->
    <section class="testimonial-section-two">
        <div class="auto-container">

        </div>
    </section>
    <!-- End Testimonial Section Two -->

    <!-- Counter Section -->
    <section class="counter-section style-two" style="background-image: url(images/background/pattern-3.png)">
        <div class="auto-container">

            <!-- Fact Counter -->
            <div class="fact-counter style-two">
                <div class="row clearfix">

                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="2500" data-stop="2350">0</span>
                                </div>
                                <h4 class="counter-title"> {{ trans('website/welcome.statisfied_patients') }}</h4>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box alternate">
                                    +<span class="count-text" data-speed="3000" data-stop="350">0</span>
                                </div>
                                <h4 class="counter-title"> {{ trans('website/welcome.doctor_team') }}</h4>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="3000" data-stop="2150">0</span>
                                </div>
                                <h4 class="counter-title">{{ trans('website/welcome.succesful_mission') }} </h4>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box">
                                    +<span class="count-text" data-speed="2500" data-stop="225">0</span>
                                </div>
                                <h4 class="counter-title"> {{ trans('website/welcome.succesful_surgeries') }}</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- End Counter Section -->

    <!-- Doctor Info Section -->
    <section class="doctor-info-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <!-- Doctor Block -->
                    <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <h3>{{ trans('website/welcome.work_hours') }}</h3>
                            <ul class="doctor-time-list">
                                <li> {{ trans('website/welcome.from_days') }}<span>8:00am–7:00pm</span></li>
                                <li> {{ trans('website/welcome.saturday') }}<span>9:00am–5:00pm</span></li>
                                <li>{{ trans('website/welcome.sunday') }}<span>9:00am–3:00pm</span></li>
                            </ul>
                            <h4>{{ trans('website/welcome.emergency_cases') }} </h4>
                            <div class="phone"> {{ trans('website/welcome.call_us') }} <strong>+898 68679 575 09</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Block -->
                    <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <h3> {{ trans('website/welcome.doctors_schedule') }}</h3>
                            <div class="text">
                                {{ trans('website/welcome.following') }}
                            </div>

                            <a href="{{ route('ShowDoctorTable') }}"
                                class="detail">{{ trans('website/welcome.more_details') }} </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Doctor Info Section -->


    <!--Clients Section-->
    <section class="clients-section">
        <div class="outer-container">


        </div>
    </section>
    <!--End Clients Section-->
@endsection
