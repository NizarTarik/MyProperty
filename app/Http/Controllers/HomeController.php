<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $byMostLikedProperties = Property::withCount(['boxes as likes_count' => function ($query) {
            $query->where('like', true);
        }])
            ->orderBy('likes_count', 'desc')
            ->paginate(9);



        return view('frontend.homepage', compact('byMostLikedProperties'));
    }

    public function properties()
    {
        $byMostLikedProperties = Property::withCount(['boxes as likes_count' => function ($query) {
            $query->where('like', true);
        }])
            ->orderBy('likes_count', 'desc')
            ->paginate(9);
        $properties = Property::paginate(9);
        return view('frontend.properties.properties', compact('properties', 'byMostLikedProperties'));
    }
    //about Us page
    public function aboutUs()
    {
        return view('frontend.aboutUs');
    }
}
