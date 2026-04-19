<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\Species;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function customer()
    {
        $users = User::with('pets')->paginate(10);

        return view('backEnd.pages.customerPet.customer', compact('users'));
    }

    public function updateCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'mobile'     => 'nullable|string|max:20',
            'location'   => 'nullable|string|max:255',
            'user_type'  => 'required|integer',
        ]);

        $user = User::find($request->id); // We need the ID from AJAX
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'mobile'     => $request->mobile,
            'location'   => $request->location,
            'user_type'  => $request->user_type,
        ]);

        return response()->json(['message' => 'User updated successfully!', 'user' => $user]);
    }



    public function saveCustomer(Request $request)
    {
        // ✅ Validate (keep simple for now)
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
        ]);

        // ✅ Save User
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->mobile = $request->mobile;
        $user->location = $request->location;

        // Profile Image
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            $filename = 'user_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/userImage');

            $file->move($destinationPath, $filename);

            $user->profile_image = 'backAssets/upload/userImage/' . $filename;
        }

        $user->save();
        
        if ($request->has('pets')) {
            foreach ($request->pets as $index => $petData) {

                $pet = new Pet();
                $pet->user_id = $user->id;
                $pet->pet_name = $petData['pet_name'] ?? null;
                $pet->pet_age = $petData['pet_age'] ?? null;
                $pet->species = $petData['species'] ?? null;
                $pet->breed = $petData['breed'] ?? null;
                $pet->status = $petData['status'] ?? 'active';
                $pet->pet_description = $petData['pet_description'] ?? null;

                // Pet Image
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
            'message' => 'Parent and pets saved successfully'
        ]);
    }






}

