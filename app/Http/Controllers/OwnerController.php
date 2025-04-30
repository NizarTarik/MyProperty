<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function becomeOwner()
    {
        return view('Owner.OwnerForm');
    }
    public function becomeOwnerPost(Request $request, $userId)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($userId);
        $user->phone = $request->phone;
        $user->address =  $request->address;
        $user->isOwner = true;
        $user->save();

        return redirect('/');
    }

    // showPostedProperties

    public function showMyPostedProperties($ownerId)
    {

        $properties = Property::where('owner_id', $ownerId)->paginate(10);

        return view('owner.MyPostedProperties', compact('properties'));
    }
    //Post Property
    public function showPropertyForm()
    {
        return view('owner.postProperty');
    }
    //Posting A property
    public function postProperty(Request $request)
    {
        $request->validate([

            'country' => 'required',
            'price' => 'required|numeric|min:0',
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'rooms' => 'required|integer|min:1',
            'city' => 'required',
            'address' => 'required',
            'postalCode' => 'required',
            'floor' => 'required',
            'img' => 'required|mimes:jpeg,png,jpg,avif',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to login to post a property.');
        }

        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $property = new Property();
        $property->name = $request->name;
        $property->description = $request->description;
        $property->numberOfRooms = $request->rooms;
        $property->floor = $request->floor;
        $property->city = $request->city;
        $property->address = $request->address;
        $property->country = $request->country;
        $property->price = $request->price;
        $property->type = $request->type;
        $property->postalCode = $request->postalCode;
        $property->owner_id = $user->id;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('frontend/img/properties'), $imageName);
            $property->img = 'frontend/img/properties/' . $imageName;
        }

        $property->save();

        return redirect()->route('properties')->with('success', 'Property added successfully!');
    }
    // delete Property
    public function deleteProperty($propertyId)
    {

        $property = Property::find($propertyId);


        if (!$property) {
            return redirect()->back()->with('error', 'Property not found.');
        }
        // delete boxes
        $property->boxes()->delete();
        // delete the property
        $property->delete();

        return redirect()->back()->with('success', 'Property deleted successfully.');
    }


    // Modify Property Code

    public function ModifyProperty($propertyId)
    {
        $property = Property::find($propertyId);

        return view('Owner.postProperty', compact('property'));
    }
    public function ModifyPropertyPost(Request $request, $propertyId)
    {
        $property = Property::find($propertyId);

        // Updating
        $property->name = $request->filled('name') ? $request->name : $property->name;
        $property->description = $request->filled('description') ? $request->description : $property->description;
        $property->numberOfRooms = $request->filled('rooms') ? $request->rooms : $property->numberOfRooms;
        $property->city = $request->filled('city') ? $request->city : $property->city;
        $property->address = $request->filled('address') ? $request->address : $property->address;
        $property->postalCode = $request->filled('postalCode') ? $request->postalCode : $property->postalCode;
        $property->floor = $request->filled('floor') ? $request->floor : $property->floor;
        $property->country = $request->filled('country') ? $request->country : $property->country;
        $property->price = $request->filled('price') ? $request->price : $property->price;
        $property->type = $request->filled('type') ? $request->type : $property->type;

        if ($request->hasFile('img')) {

            $imagePath = $request->file('img')->store('property_images');
            $property->img = $imagePath;
        }

        $property->save();

        $properties = Property::where('owner_id', auth()->user()->id)->paginate(10);

        return view('owner.MyPostedProperties', compact('properties'));
    }
}
