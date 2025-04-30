@extends('layouts.frontend')

@section('content')
    <section class="categories" style="margin-bottom: 30px">
        <div class="container">
            <div class="hero__text" style="text-align: center; margin-bottom:15px">
                <form class="vstack gap-2"
                    action="{{ isset($property->id) ? route('modifyPropertyPost', ['propertyId' => $property->id]) : route('postProperty') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box">
                        <input type="text" name="name" placeholder="Name"
                            value="{{ old('name', $property->name ?? '') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <textarea name="description" placeholder="A Small Description">{{ old('description', $property->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" name="rooms" placeholder="Number Of Rooms"
                            value="{{ old('rooms', $property->rooms ?? '') }}">
                        @error('rooms')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="box">
                        <input type="text" name="city" placeholder="City"
                            value="{{ old('city', $property->city ?? '') }}">
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="address" placeholder="Address"
                            value="{{ old('address', $property->address ?? '') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="postalCode" placeholder="Postal Code"
                            value="{{ old('postalCode', $property->postalCode ?? '') }}">
                        @error('postalCode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="box">
                        <input type="file" name="img">
                        @error('img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" name="floor" placeholder="Floor"
                            value="{{ old('floor', $property->floor ?? '') }}">
                        @error('floor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="country" placeholder="Country"
                            value="{{ old('country', $property->country ?? '') }}">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" name="price" placeholder="Price"
                            value="{{ old('price', $property->price ?? '') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <select name="type">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Apartment"
                            {{ old('type', $property->type ?? '') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ old('type', $property->type ?? '') == 'House' ? 'selected' : '' }}>House
                        </option>
                        <option value="Villa" {{ old('type', $property->type ?? '') == 'Villa' ? 'selected' : '' }}>Villa
                        </option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit"
                        class="primary-btn">{{ isset($property->id) ? 'Modify Property' : 'Post Property' }}</button>
                </form>
            </div>
        </div>
        <style>
            form {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 20px;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            form .box {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 15px;
                width: 100%;
            }

            form .box input,
            form .box textarea,
            select {
                flex: 1 1 30%;
                min-width: 250px;
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            textarea {
                resize: vertical;
            }

            .text-danger {
                color: #e74c3c;
                font-size: 14px;
            }

            .primary-btn {
                padding: 12px 25px;
                background-color: #007bff;
                color: white;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .primary-btn:hover {
                background-color: #0056b3;
            }

            @media (max-width: 768px) {
                form .box {
                    flex-direction: column;
                    align-items: stretch;
                }
            }
        </style>

    </section>
@endsection
