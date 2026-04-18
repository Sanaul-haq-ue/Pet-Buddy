<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'pet_count' => 'required|integer|min:1',
            'payment_method' => 'required',
            'account_number' => 'required',
            'transaction_id' => 'required',
            'pets' => 'required|array|min:1'
        ]);

        DB::beginTransaction();

        try {
            $appointment = Appointment::create([
                'service_id' => $request->service_id,
                'user_id' => auth()->id(),
                'date' => $request->date,
                'time' => $request->time,
                'pet_count' => $request->pet_count,
                'payment_method' => $request->payment_method,
                'account_number' => $request->account_number,
                'transaction_id' => $request->transaction_id,
            ]);

            foreach ($request->pets as $pet) {
                AppointmentPet::create([
                    'appointment_id' => $appointment->id,
                    'type' => $pet['type'],
                    'name' => $pet['name'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking successful!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
