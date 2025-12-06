<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // عرض جميع المواعيد
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // الادمن يشوف الكل
            return Appointment::with(['user', 'animal', 'adoptionRequest'])->get();
        } else {
            // المستخدم يشوف بس مواعيده
            return Appointment::with(['user', 'animal', 'adoptionRequest'])
                              ->where('user_id', $user->id)
                              ->get();
        }
    }

    // إضافة موعد جديد
    public function store(StoreAppointmentRequest $request)
    {
        $user = Auth::user();

        // إذا مو أدمن، نجبر user_id = المستخدم الحالي
        $data = $request->validated();
        if ($user->role !== 'admin') {
            $data['user_id'] = $user->id;
        }

        $appointment = Appointment::create($data);
        return response()->json($appointment, 201);
    }

    // عرض موعد محدد
    public function show(Appointment $appointment)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $appointment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $appointment->load(['user', 'animal', 'adoptionRequest']);
    }

    // تحديث موعد
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $appointment->update($request->validated());
        return response()->json($appointment);
    }

    // حذف موعد
    public function destroy(Appointment $appointment)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }
}
