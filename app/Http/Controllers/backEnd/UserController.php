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
        $users = User::with(['pets.species', 'pets.breed'])->paginate(10);

        $species = Species::where('status', '1')->get();

        return view(
            'backEnd.pages.customerPet.customer',
            compact('users', 'species')
        );
    }

    public function getBreeds($species_id)
    {
        $breeds = Breed::where('species_id', $species_id)->get();
        return response()->json($breeds);
    }


    public function saveCustomer(Request $request)
    {
        // Validate
        $request->validate([
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

        try {

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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }




    public function updateCustomer(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|integer|exists:users,id',
            'first_name' => 'required|string|max:255',
            'email'      => 'required|email|max:255',
        ]);

        $user = User::findOrFail($request->user_id);

        // Update basic user fields
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name  ?? $user->last_name;
        $user->email      = $request->email;
        $user->mobile     = $request->mobile     ?? $user->mobile;
        $user->location   = $request->location   ?? $user->location;

        // Profile image
        if ($request->hasFile('profile_image')) {
            $file     = $request->file('profile_image');
            $filename = 'user_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backAssets/upload/userImage'), $filename);
            $user->profile_image = 'backAssets/upload/userImage/' . $filename;
        }

        $user->save();

        // Pets — update existing or create new
        $petIds     = $request->input('pet_id',          []);
        $petNames   = $request->input('pet_name',        []);
        $petAges    = $request->input('pet_age',         []);
        $petSpecies = $request->input('species',         []);
        $petBreeds  = $request->input('breed',           []);
        $petDescs   = $request->input('pet_description', []);

        foreach ($petNames as $index => $petName) {
            $petId = $petIds[$index] ?? null;

            // Determine status from radio (sent as status_0, status_1, ...)
            $status = $request->input("status_{$index}", 1);

            $pet = ($petId && is_numeric($petId)) ? Pet::find($petId) : null;

            if (!$pet) {
                $pet = new Pet();
                $pet->user_id = $user->id;
            }

            $pet->pet_name        = $petName;
            $pet->pet_age         = $petAges[$index]    ?? null;
            $pet->species         = $petSpecies[$index]  ?? null;
            $pet->breed           = $petBreeds[$index]   ?? null;
            $pet->status          = $status;
            $pet->pet_description = $petDescs[$index]   ?? null;

            // Pet image
            if ($request->hasFile("pet_image.{$index}")) {
                $file     = $request->file("pet_image.{$index}");
                $filename = 'pet_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backAssets/upload/petImage'), $filename);
                $pet->pet_image = 'backAssets/upload/petImage/' . $filename;
            }

            $pet->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully!',
        ]);
    }

    public function deleteCustomer($id)
    {
        $user = User::with('pets')->findOrFail($id);

        // delete pets + images
        foreach ($user->pets as $pet) {
            if ($pet->pet_image && file_exists(public_path($pet->pet_image))) {
                unlink(public_path($pet->pet_image));
            }
            $pet->delete();
        }

        // delete profile image
        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        $user->delete();

        return response()->json([
            'message' => 'Customer and all pets deleted successfully!'
        ]);
    }
}
