<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Property;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function filter(Request $request)
    {
        $query = Property::query();

        if ($request->has('byType') && $request->filled('byType') && $request->byType !== 'any') {
            $query->where('type', $request->byType);
        }
        if ($request->has('byRoom') && $request->filled('byRoom') && $request->byRoom !== 'any') {
            if ($request->byRoom === 'higher') {
                $query->where('numberOfRooms', '>', 5);
            } else {
                $query->where('numberOfRooms', $request->byRoom);
            }
        }
        if ($request->has('byFloor') && $request->filled('byFloor') && $request->byFloor !== 'any') {
            if ($request->byFloor === 'higher') {
                $query->where('floor', '>', 5);
            } else {
                $query->where('floor', $request->byFloor);
            }
        }
        if ($request->has('maxPrice') && $request->filled('maxPrice')) {
            $query->where('price', '<=', $request->maxPrice);
        }
        if ($request->has('minPrice') && $request->filled('minPrice')) {
            $query->where('price', '>=', $request->minPrice);
        }

        $properties = $query->paginate(9);
        // getting Most Liked Properties
        $byMostLikedProperties = Property::withCount(['boxes as likes_count' => function ($query) {
            $query->where('like', true);
        }])
            ->orderBy('likes_count', 'desc')
            ->paginate(9);

        return view('frontend.properties.properties', compact('properties', 'byMostLikedProperties'));
    }

    public function propertyInfo($propertyId)
    {
        $property = Property::with('seller')->findOrFail($propertyId);


        $relatedProperties = Property::where('type', $property->type)

            ->where('price', '>=', $property->price - 100000)
            ->where('price', '<=', $property->price + 100000)

            ->where('id', '!=', $propertyId)
            ->get();

        return view('frontend.properties.propertyInfo', compact('property', 'relatedProperties'));
    }


    //Like
    public function like($propertyId)
    {
        $box = Box::where('user_id', auth()->user()->id)
            ->where('property_id', $propertyId)
            ->first();

        if ($box) {
            if (!$box->like) {
                $box->like = true;
                $box->save();
            }
        } else {
            $box = new Box();
            $box->like = true;
            $box->user_id = auth()->user()->id;
            $box->property_id = $propertyId;
            $box->save();
        }

        return redirect()->back();
    }

    //BookMark
    public function bookMark($propertyId)
    {
        $box = Box::where('user_id', auth()->user()->id)
            ->where('property_id', $propertyId)
            ->first();

        if ($box) {
            if (!$box->bookmark) {
                $box->bookmark = true;
                $box->save();
            }
        } else {
            $box = new Box();
            $box->bookmark = true;
            $box->user_id = auth()->user()->id;
            $box->property_id = $propertyId;
            $box->save();
        }

        return redirect()->back();
    }


    public function showBookMark()
    {

        if (auth()->user()) {
            $bookmarkedPropertyIds = auth()->user()->boxes()
                ->where(function ($query) {
                    $query->where('bookmark', 1);
                })
                ->pluck('property_id');
        } else {

            return redirect('login');
        }



        $bookmarks = Property::whereIn('id', $bookmarkedPropertyIds)->paginate(10);

        return view('frontend.properties.showBookMark', compact('bookmarks'));
    }
}
