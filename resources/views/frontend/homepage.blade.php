@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="mb-5">
        <div class="container">
            <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
                <div class="hero__text">
                    <span style="color: rgb(224, 224, 224)">My Property</span>
                    <h2>Find your <br />Suitable Property here</h2>
                    <p style="color: rgb(226, 226, 226)">Properties Owner Around the World Posting their Properties here for
                        you!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories" style="margin-bottom: 30px">
        <div class="container">
            <div class="hero__text" style="text-align: center; margin-bottom:15px">
                <span style="font-size: 1.4em;">The Most Liked Properties</span>
            </div>
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($byMostLikedProperties as $property)
                        <div class="col-lg-3">
                            <p>{{ $property->name }} || <b>{{ $property->city }}</b></p>
                            @php
                                $imageUrl = filter_var($property->img, FILTER_VALIDATE_URL)
                                    ? $property->img
                                    : asset($property->img);
                            @endphp
                            <div class="categories__item set-bg" data-setbg="{{ $imageUrl }}">
                                <h5><a
                                        href="{{ route('propertyInfo', ['propertyId' => $property->id]) }}">{{ $property->name }}</a>
                                </h5>
                                <div class="Property-Icons">
                                    <!-- like Logic -->
                                    <a href="@auth {{ route('like', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() &&auth()->user()->boxes()->where('property_id', $property->id)->where('like', true)->exists()? 'red': 'white' }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ $property->boxes()->where('like', true)->count() }} Likes</span>
                                    </a>
                                    <a href="@auth {{ route('bookMark', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() &&auth()->user()->boxes()->where('property_id', $property->id)->where('bookMark', true)->exists()? 'black': 'white' }}">
                                        <i class="fa fa-bookmark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <div style="text-align: center;margin:35px;"> <a href="{{ route('properties') }}" style="padding: 20px;"
            class="primary-btn">Show More
        </a>
    </div>
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-2.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .Property-Icons a {
            padding: 30px 20px;
            font-size: 17px:
        }

        .Property-Icons a:hover {
            color: black;
        }
    </style>
    <!-- Banner End -->
@endsection
