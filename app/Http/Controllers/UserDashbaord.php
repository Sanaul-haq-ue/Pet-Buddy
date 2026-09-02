<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Order;
use App\Models\Pet;
use App\Models\Species;
use App\Services\OrderStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashbaord extends Controller
{
    public function dashboard()
    {
        $species = Species::where('status', '1')->get();

        $user = Auth::user();

        $pets = Pet::where('user_id', $user->id)
            ->where('status', '1')
            ->with(['species', 'breed'])
            ->get();

        $ongoingOrders = Order::where(function ($query) use ($user) {
            $query->where('user_id', $user->id);

            if (!empty($user->mobile)) {
                $query->orWhere('shipping_mobile', $user->mobile);
            }
        })
            ->whereNotIn('tracking_stage', ['delivered', 'cancelled'])
            ->latest()
            ->get();

        $completedOrders = Order::where(function ($query) use ($user) {
            $query->where('user_id', $user->id);

            if (!empty($user->mobile)) {
                $query->orWhere('shipping_mobile', $user->mobile);
            }
        })
            ->whereIn('tracking_stage', ['delivered', 'cancelled'])
            ->latest()
            ->get();

        return view('frontEnd.dashboard', compact('ongoingOrders', 'completedOrders', 'species', 'pets'));
    }


    public function trackOrder($order_no)
    {
        $order = Order::with(['items.product', 'payType', 'payMethod', 'statusLogs'])
            ->where('order_no', $order_no)
            ->firstOrFail();

        $history      = OrderStatusService::history($order);      // real dated log, oldest → newest
        $isCancelled  = OrderStatusService::isCancelled($order);
        $isDelivered  = OrderStatusService::isDelivered($order);

        return view('frontEnd.order.track-show', compact('order', 'history', 'isCancelled', 'isDelivered'));
    }

    public function getBreeds($species_id)
    {
        return Breed::where('species_id', $species_id)->get();
    }


    public function savePet(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'pets' => 'required|array|min:1',
            'pets.*.pet_name' => 'required|string|max:255',
            'pets.*.pet_age' => 'required|numeric',
            'pets.*.species' => 'required',
            'pets.*.breed' => 'required',
            'pets.*.status' => 'required|in:0,1',
        ]);

        try {
            if ($request->has('pets')) {
                foreach ($request->pets as $index => $petData) {

                    $pet = new Pet();
                    $pet->user_id = $user->id;
                    $pet->pet_name = $petData['pet_name'] ?? null;
                    $pet->pet_age = $petData['pet_age'] ?? null;
                    $pet->species = $petData['species'] ?? null;
                    $pet->breed = $petData['breed'] ?? null;
                    $pet->status = $petData['status'] ?? 1;
                    $pet->pet_description = $petData['pet_description'] ?? null;

                    if ($request->hasFile("pets.$index.image")) {
                        $file = $request->file("pets.$index.image");
                        $filename = 'pet_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('backAssets/upload/petImage');
                        $file->move($destinationPath, $filename);
                        $pet->pet_image = 'backAssets/upload/petImage/' . $filename;
                    }
                    $pet->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'pets saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function updatePet(Request $request, Pet $pet)
    {
        // Ensure the pet belongs to the logged-in user
        if ($pet->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'pet_name'    => 'required|string|max:255',
            'pet_age'     => 'required|numeric',
            'species'     => 'required',
            'breed'       => 'required',
            'pet_description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        try {
            $pet->pet_name = $request->pet_name;
            $pet->pet_age = $request->pet_age;
            $pet->species = $request->species;
            $pet->breed = $request->breed;
            $pet->pet_description = $request->pet_description;
            $pet->status = $pet->status ?? 1; // keep existing status, default to 1 if somehow null

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($pet->pet_image && file_exists(public_path($pet->pet_image))) {
                    unlink(public_path($pet->pet_image));
                }

                $file = $request->file('image');
                $filename = 'pet_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('backAssets/upload/petImage');
                $file->move($destinationPath, $filename);
                $pet->pet_image = 'backAssets/upload/petImage/' . $filename;
            }

            $pet->save();

            return response()->json([
                'success' => true,
                'message' => 'Pet updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function softDeletePet(Pet $pet)
    {
        // Ensure the pet belongs to the logged-in user
        if ($pet->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        try {
            $pet->status = 0;
            $pet->save();

            return response()->json([
                'success' => true,
                'message' => 'Pet deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'location'   => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|string',
        ]);

        try {
            // Basic info (email & mobile intentionally excluded — never updated here)
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->location = $request->location;

            // Handle password change only if all 3 fields are filled
            if ($request->filled('current_password') || $request->filled('new_password') || $request->filled('confirm_password')) {

                if (!$request->filled('current_password') || !$request->filled('new_password') || !$request->filled('confirm_password')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please fill all three password fields to change your password.'
                    ], 422);
                }

                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Current password is incorrect.'
                    ], 422);
                }

                if ($request->new_password !== $request->confirm_password) {
                    return response()->json([
                        'success' => false,
                        'message' => 'New password and confirmation do not match.'
                    ], 422);
                }

                $user->password = Hash::make($request->new_password);
            }

            // Handle profile image change
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                    unlink(public_path($user->profile_image));
                }

                $file = $request->file('profile_image');
                $filename = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('backAssets/upload/profileImage');
                $file->move($destinationPath, $filename);
                $user->profile_image = 'backAssets/upload/profileImage/' . $filename;
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
