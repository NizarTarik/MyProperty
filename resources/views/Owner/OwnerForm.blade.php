@extends('layouts.frontend')

@section('content')
    <section class="categories mb-8">
        <div class="container">
            <div class="hero__text text-center mb-4">
                <h2 class="text-2xl font-bold mb-2">Sell Your Properties Now By Becoming A Seller!</h2>
                <p class="mb-6">Please Finish This Form</p>
                <form action="{{ route('becomeOwnerPost', ['userId' => auth()->user()->id]) }}" method="post"
                    class="space-y-4 max-w-md mx-auto">
                    @csrf
                    <input type="text" name="address" class="w-full px-4 py-2 border rounded"
                        placeholder="Enter Your Address" required>
                    <input type="number" name="phone" class="w-full px-4 py-2 border rounded"
                        placeholder="Enter Your Phone Number" required>
                    <button type="submit" class="primary-btn w-full py-2">Become A Seller</button>
                </form>
            </div>
        </div>
    </section>
@endsection
