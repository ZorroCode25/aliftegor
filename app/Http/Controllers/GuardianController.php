<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Models\Guardian;
use App\Models\PickupHistory;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class GuardianController extends Controller
{
    public function dashboard()
    {

        $guardian = auth()->user()->guardian;
        $code = Crypt::encrypt($guardian->id);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . $code . ''; // Ganti dengan URL QR asli
        // $students = $guardian->students;
        $students = Student::whereIn('id', $guardian->student_ids)->get();


        return view('guardian.dashboard', compact('qrCodeUrl', 'students'));
    }

    public function history(Request $request)
    {
        $guardian = auth()->user()->guardian;
        $students = Student::whereIn('id', $guardian->student_ids)->get();
        $studentId = $request->input('student_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Default filter: bulan ini jika tidak ada input
        if (!$startDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
        }
        if (!$endDate) {
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }


        $histories = PickupHistory::whereBetween('date', [$startDate, $endDate])
            ->when($studentId, function ($query) use ($studentId) {
                return $query->where('student_id', $studentId);
            })
            ->paginate(10);

        return view('guardian.history', compact('histories', 'students', 'startDate', 'endDate'));
    }
}
