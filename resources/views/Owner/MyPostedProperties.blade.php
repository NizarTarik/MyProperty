@extends('layouts.frontend')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="box">
                @foreach ($properties as $property)
                    <div class="card">
                        <img src="{{ asset($property->img) }}" alt="">
                        <div class="card-body">
                            <p class="card-text" style="color: whitesmoke">
                                <a href="#">
                                    <h3><b>{{ $property->name }}</b></h3>
                                </a><br>{{ $property->type }}<br>{{ $property->country }} | |
                                {{ $property->city }}<br>{{ $property->price }} DH
                            </p>

                            <a href="{{ route('modifyProperty', ['propertyId' => $property->id]) }}" class="primary-btn"
                                onclick="return confirm('Go To Modify Page?')">Modify</a>




                            <a href="{{ route('deleteProperty', ['propertyId' => $property->id]) }}" class="primary-btn"
                                onclick="return confirm('Are you sure you want to delete this property?')">Delete</a>

                        </div>
                        <!-- the  like Logic -->
                        <div class="Property-Icons">
                            <a href="@auth {{ route('like', ['propertyId' => $property->id]) }} @else {{ route('login') }} @endauth"
                                style="color: {{ auth()->check() &&auth()->user()->boxes()->where('property_id', $property->id)->where('like', true)->exists()? 'red': 'silver' }}">
                                <i class="fa fa-heart"></i>
                                <span>{{ $property->boxes()->where('like', true)->count() }} Likes</span>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{ $properties->links() }}

    <style>
        .box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            flex: 0 0 calc(33.33% - 20px);
            margin-bottom: 20px;
        }

        .Property-Icons a {
            color: white;
            padding: 30px;
        }

        .Property-Icons:hover {
            transform: scale(1.1);
            transition: .5s;
            color: rgb(25, 184, 25);
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
    </style>
@endsection
