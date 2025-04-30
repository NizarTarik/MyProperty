@extends('layouts.frontend')

@section('content')
    <section class="mb-5" style="margin: 20px">
        <div class="container">
            <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/aboutUs.jpeg') }}">
                <div class="hero__text">

                    <h2>About Us</h2>
                    <p style="color: rgb(255, 255, 255);font-size:1.1em">
                        My Property is a platform that connects property owners with potential buyers and renters. We
                        provide a user-friendly interface for property owners to list their properties and for
                        users to search for their ideal properties. Our mission is to simplify the process of buying,
                        selling, and renting properties, making it accessible to everyone.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
