@extends('layouts.frontend')

@section('content')
    <section class="categories" style="margin-bottom: 30px">
        <div class="container">
            <div class="hero__text" style="text-align: center; margin-bottom: 15px;">
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
                                <h5>
                                    <a
                                        href="{{ route('propertyInfo', ['propertyId' => $property->id]) }}">{{ $property->name }}</a>
                                </h5>
                                <div class="Property-Icons">
                                    <a href="@auth {{ route('like', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() && auth()->user()->boxes()->where('property_id', $property->id)->where('like', true)->exists() ? 'red' : 'white' }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ $property->boxes()->where('like', true)->count() }} Likes</span>
                                    </a>
                                    <a href="@auth {{ route('bookMark', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() && auth()->user()->boxes()->where('property_id', $property->id)->where('bookMark', true)->exists() ? 'black' : 'white' }}">
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
    <!-- Form Section -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('filter') }}" method="GET">
                        <div style="display: flex">
                            <select name="byType">
                                <option value="" disabled {{ request('byType') ? '' : 'selected' }}>Type</option>
                                <option value="any" {{ request('byType') == 'any' ? 'selected' : '' }}>Any</option>
                                <option value="Villa" {{ request('byType') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Apartement" {{ request('byType') == 'Apartement' ? 'selected' : '' }}>
                                    Apartement</option>
                                <option value="House" {{ request('byType') == 'House' ? 'selected' : '' }}>House</option>
                                <option value="Other" {{ request('byType') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <select name="byRoom">
                                <option value="" disabled {{ request('byRoom') ? '' : 'selected' }}>Rooms</option>
                                <option value="any" {{ request('byRoom') == 'any' ? 'selected' : '' }}>Any</option>
                                <option value="1" {{ request('byRoom') == '1' ? 'selected' : '' }}>1 room</option>
                                <option value="2" {{ request('byRoom') == '2' ? 'selected' : '' }}>2 rooms</option>
                                <option value="3" {{ request('byRoom') == '3' ? 'selected' : '' }}>3 rooms</option>
                                <option value="4" {{ request('byRoom') == '4' ? 'selected' : '' }}>4 rooms</option>
                                <option value="5" {{ request('byRoom') == '5' ? 'selected' : '' }}>5 rooms</option>
                                <option value="higher" {{ request('byRoom') == 'higher' ? 'selected' : '' }}>Higher
                                </option>
                            </select>
                            <select name="byFloor">
                                <option value="" disabled {{ request('byFloor') ? '' : 'selected' }}>Floor</option>
                                <option value="any" {{ request('byFloor') == 'any' ? 'selected' : '' }}>Any</option>
                                <option value="0" {{ request('byFloor') == '0' ? 'selected' : '' }}>0 floor</option>
                                <option value="1" {{ request('byFloor') == '1' ? 'selected' : '' }}>1 floor</option>
                                <option value="2" {{ request('byFloor') == '2' ? 'selected' : '' }}>2 floors</option>
                                <option value="3" {{ request('byFloor') == '3' ? 'selected' : '' }}>3 floors</option>
                                <option value="4" {{ request('byFloor') == '4' ? 'selected' : '' }}>4 floors</option>
                                <option value="5" {{ request('byFloor') == '5' ? 'selected' : '' }}>5 floors</option>
                                <option value="higher" {{ request('byFloor') == 'higher' ? 'selected' : '' }}>Higher
                                </option>
                            </select>
                        </div>
                        <input type="text" name="minPrice" placeholder="Min Price" value="{{ request('minPrice') }}">
                        <input type="text" name="maxPrice" placeholder="Max Price" value="{{ request('maxPrice') }}">
                        <button type="submit" class="site-btn">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Properties List Section -->
    <section class="hero">
        <div class="container">
            <div class="box">
                @forelse ($properties as $property)
                    @php
                        $imageUrl = filter_var($property->img, FILTER_VALIDATE_URL)
                            ? $property->img
                            : asset($property->img);
                    @endphp
                    <div class="card">
                        <div class="categories__item set-bg" data-setbg="{{ $imageUrl }}">
                            <div class="card-body">
                                <p class="card-text" style="color: #1b3836">
                                    {{ $property->name }}|| {{ $property->type }}<br>{{ $property->country }}
                                    <br> Floor {{ $property->floor }} ||
                                    {{ $property->numberOfRooms }} Rooms<br>{{ $property->price }} DH
                                </p>
                                <div class="Property-Icons">
                                    <a href="@auth {{ route('like', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() && auth()->user()->boxes()->where('property_id', $property->id)->where('like', true)->exists() ? 'rgb(220, 20, 60)' : 'white' }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ $property->boxes()->where('like', true)->count() }} Likes</span>
                                    </a>
                                    <a href="@auth {{ route('bookMark', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                        style="color: {{ auth()->check() && auth()->user()->boxes()->where('property_id', $property->id)->where('bookMark', true)->exists() ? 'black' : 'white' }}">
                                        <i class="fa fa-bookmark"></i>
                                    </a>
                                    <a href="{{ route('propertyInfo', ['propertyId' => $property->id]) }}"
                                        class="primary-btn">MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Sorry, No Properties Found with this Filter</h2>
                @endforelse
            </div>

            {{ $properties->links() }}
        </div>
    </section>

    <!-- Custom Script for setting background images -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elements = document.querySelectorAll('.set-bg');
            elements.forEach(function(el) {
                var bg = el.getAttribute('data-setbg');
                el.style.backgroundImage = 'url(' + bg + ')';
            });
        });
    </script>

    <style>
        .card {
            box-shadow: 1px 1px 5px rgb(235, 235, 235);
        }

        .card-text {
            letter-spacing: 1.2px;
            font-size: 1em;
            color: rgb(14, 14, 14);
            font-weight: bold;
        }

        input {
            color: grey;
            padding: 6px;
        }

        .Property-Icons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            color: white;
            padding: 0 20px;
        }

        .Property-Icons:hover {
            transform: scale(1);
            transition: .5s;
            color: rgb(25, 184, 25);
        }

        .box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            flex: 0 0 calc(33.33% - 20px);
            margin-bottom: 20px;
        }

        @media screen and (max-width: 950px) {
            .card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media screen and (max-width: 580px) {
            .card {
                flex: 0 0 calc(100% - 20px);
            }
        }

        .pagination-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-links .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination-links .pagination li {
            margin: 0 5px;
        }

        .pagination-links .pagination li a {
            color: #333;
            padding: 8px 12px;
            border-radius: 5px;
            background: #f1f1f1;
            text-decoration: none;
        }

        .pagination-links .pagination li a:hover {
            background: #007bff;
            color: white;
        }
    </style>


    <!--  Script for setting background images -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elements = document.querySelectorAll('.set-bg');
            elements.forEach(function(el) {
                var bg = el.getAttribute('data-setbg');
                el.style.backgroundImage = 'url(' + bg + ')';
            });
        });
    </script>
@endsection
