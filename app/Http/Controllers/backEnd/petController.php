<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Species;
use Illuminate\Http\Request;

class petController extends Controller
{
    public function petManagement()
    {
        $species = Species::where('status', 1)->get();
        $breeds = Breed::where('status', 1)->get();
        $totalSpecies = $species->count();
        $totalBreeds = $breeds->count();

        return view('backEnd.pages.customerPet.petManagement', compact('species', 'breeds', 'totalSpecies', 'totalBreeds'));
    }

    // //// Pet Management Species Management Section

    public function saveSpecies(Request $request)
    {
        $request->validate([
            'species_name' => 'required|string|max:255',
            'scientific_classification' => 'nullable|string|max:255',
            'care_notes' => 'nullable|string',
        ]);

        Species::create([
            'species_name' => $request->species_name,
            'scientific_classification' => $request->scientific_classification,
            'care_notes' => $request->care_notes,
            'status' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Species saved successfully.',
        ]);
    }

    // //// Pet Management Breed Management Section

    public function saveBreed(Request $request)
    {
        $request->validate([
            'breed_name' => 'required|string|max:255',
            'species_id' => 'required|exists:species,id',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $breedData = [
            'breed_name' => $request->breed_name,
            'species_id' => $request->species_id,
            'status' => $request->status,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'breed_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/breedImage');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $breedData['image'] = 'backAssets/upload/breedImage/'.$filename;
        }

        Breed::create($breedData);

        return response()->json([
            'success' => true,
            'message' => 'Breed saved successfully.',
        ]);
    }

    public function updateBreed(Request $request, $id)
    {
        $breed = Breed::findOrFail($id);

        $request->validate([
            'breed_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $breedData = [
            'breed_name' => $request->breed_name,
            'status' => $request->status,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($breed->image && file_exists(public_path($breed->image))) {
                unlink(public_path($breed->image));
            }

            $file = $request->file('image');
            $filename = 'breed_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/breedImage');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $breedData['image'] = 'backAssets/upload/breedImage/'.$filename;
        }

        $breed->update($breedData);

        return response()->json([
            'success' => true,
            'message' => 'Breed updated successfully.',
        ]);
    }

    public function deleteBreed($id)
    {
        $breed = Breed::findOrFail($id);

        if ($breed->image && file_exists(public_path($breed->image))) {
            unlink(public_path($breed->image));
        }

        $breed->delete();

        return response()->json([
            'success' => true,
            'message' => 'Breed deleted successfully.',
        ]);
    }
}
