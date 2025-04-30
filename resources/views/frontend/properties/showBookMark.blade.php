@extends('layouts.frontend')
@section('content')
    <div class="container">

        <section class="hero">
            <div class="container">
                <div class="box">
                    @forelse ($bookmarks as $bookmark)
                        <div class="card">
                            <div class="categories__item set-bg" data-setbg="{{ asset($bookmark->img) }}">
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $bookmark->name }}<br>{{ $bookmark->country }} ||
                                        {{ $bookmark->city }}<br>{{ $bookmark->address }}<br> Floor {{ $bookmark->floor }}
                                        ||
                                        {{ $bookmark->numberOfRooms }} Rooms<br>{{ $bookmark->price }} DH
                                    </p>

                                    <div class="Property-Icons">
                                        <a href="@auth {{ route('like', ['propertyId' => $bookmark->id]) }} @else {{ route('login') }} @endauth"
                                            style="color: {{ auth()->check() &&auth()->user()->boxes()->where('property_id', $bookmark->id)->where('like', true)->exists()? 'rgb(220, 20, 60)': 'white' }}">
                                            <i class="fa fa-heart"></i>
                                            <span>{{ $bookmark->boxes()->where('like', true)->count() }} Likes</span>
                                        </a>
                                        <a href="@auth {{ route('bookMark', ['propertyId' => $bookmark->id]) }} @else {{ route('login') }} @endauth"
                                            style="color: {{ auth()->check() &&auth()->user()->boxes()->where('property_id', $bookmark->id)->where('bookMark', true)->exists()? 'black': 'white' }}">
                                            <i class="fa fa-bookmark"></i>
                                        </a>
                                        <a href="{{ route('propertyInfo', ['propertyId' => $bookmark->id]) }}"
                                            class="primary-btn">MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2>Sorry, No Properties Found with this Filter</h2>
                    @endforelse
                </div>
                <div class="pagination-links">
                    {{ $bookmarks->links() }}
                </div>

            </div>
        </section>
    </div>
@endsection

<style>
    .box {
        gap: 15px;
        display: flex;
        flex-direction: column;
        width: 50%;
        margin: auto;
    }

    .card p {
        color: rgb(17, 17, 17);
        font-size: .9em;
        font-weight: bold;
    }

    .Property-Icons {
        display: flex;
        font-size: 17px;
        align-items: center;
        justify-content: start;
        gap: 15px;
    }

    @media screen and (max-width: 780px) {

        .box {
            width: 100%
        }
    }
</style>
