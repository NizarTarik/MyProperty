@extends('layouts.frontend')

@section('content')
    <div class="content">
        <div class="property-card">
            <img src="{{ asset($property->img) }}" alt="">
            <div class="card-info">
                <div class="box">
                    <p class="card-text">
                        <a href="#">
                            <h3><b>{{ $property->name . ' | | ' . $property->type }}</b></h3>
                        </a><br><b>Country :</b>{{ $property->country }} | | <br> <b>City : </b>{{ $property->city }}<br>
                        <b>Small Description : </b>{{ $property->description }}<br>{{ $property->numberOfRooms }}
                        <span>rooms</span> || Floor
                        {{ $property->floor }}<br>
                        <span><b>Postal Code :</b> </span> {{ $property->postalCode }}<br> <b>Price :
                        </b>{{ $property->price }} DH
                    </p>
                </div>
                <div class="box" id="right">
                    <h2>Seller</h2>
                    <p class="card-text">
                        {{ $property->seller->username }} | |
                        {{ $property->seller->email }}<br><b>Address :</b>
                        {{ $property->seller->address }}<br><b>Phone :</b>
                        {{ $property->seller->phone }}
                    </p>

                </div>
            </div>
        </div>

        <section class="categories" style="margin-bottom: 30px">
            <div class="container">
                <div class="hero__text" style="text-align: center; margin-bottom: 15px">
                    <span style="font-size: 1.4em;">Related Properties</span>
                </div>
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        @foreach ($relatedProperties as $relatedProperty)
                            <div class="col-lg-10">
                                <div class="categories__item set-bg" data-setbg="{{ asset($relatedProperty->img) }}">
                                    <h5><a href="">{{ $relatedProperty->name }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>


    </div>

    <style>
        .content {
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 0 0 calc(50% - 20px);
            width: 100%;
            flex-direction: column;
            gap: 15px;
        }

        .property-card {
            display: flex;

        }

        .property-card .card-info {
            display: flex;
            justify-content: center;


        }

        .content .property-card {
            width: 50%;
            display: flex;
            justify-content: space-around;
            margin-left: -45px;
        }

        .content .property-card img {
            width: 80%;
        }

        .card-info {
            width: 100%;
            padding: 30px;

        }

        section {
            width: 80%;
        }

        .Property-Icons {
            color: white;
            padding: 20px;
        }

        .box {
            padding: 15px;
        }

        #right {

            border-left: 1px solid grey;
            padding: 20px;
        }

        .Property-Icons:hover {
            transform: scale(3);
            transition: .5s;
        }

        .content {
            flex: 0 0 calc(50% - 20px);
        }

        .content .property-card {
            width: 60%;
        }

        .property-card img {
            align-items: center;
            margin: auto;
            width: 100%;
        }

        .card-info {
            flex-direction: column;
        }

        .property-card {

            flex-direction: column;
        }



        @media screen and (max-width: 580px) {
            .content {
                flex: 0 0 calc(100% - 20px);

            }

            .box {
                padding: 0;
            }

            .property-card img {
                align-items: center;
                width: 100%;
            }

            .property-card .card-info {
                width: 100%
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function setBackgroundImages() {
            $('.set-bg').each(function() {
                var bg = $(this).data('setbg');
                $(this).css('background-image', 'url(' + bg + ')');
            });
        }

        $(document).ready(function() {
            setBackgroundImages();

            // Re-run setBackgroundImages() when navigating to a new page
            $(document).on('page:load', function() {
                setBackgroundImages();
            });
        });
    </script>
@endsection
