<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\PickupHistory;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    public function showScanPage()
    {
        return view('guardian.scan_qr'); // Nama file blade Anda
    }

    public function validateQr(Request $request)
    {
        $qrData = $request->input('qr_code');
        $guardian = Guardian::where('qr_unique_code', $qrData)->first();
        $students = Student::whereIn('id', $guardian->student_ids)->get();
        if ($guardian && $students->isNotEmpty()) {
            return redirect()->route('scan.showConfirmation', [
                'identifier' => $guardian->id,
                'original_qr' => $qrData
            ]);
        } elseif ($guardian && $students->isEmpty()) {
            return redirect()->route('scan.page')->with('scan_error', 'Wali murid ini belum memiliki data anak yang tertaut.');
        } else {
            return redirect()->route('scan.page')->with('scan_error', 'QR Code tidak valid atau tidak terdaftar.');
        }
    }


    public function showConfirmationPage($identifier, Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($identifier);
        } catch (DecryptException $e) {
            return redirect()->route('scan.page')->with('scan_error', 'QR Code tidak valid atau telah kedaluwarsa.');
        }

        $guardian = Guardian::with('students')->find($decrypted);
        // $students = $guardian->students;
        $students = Student::whereIn('id', $guardian->student_ids)->get();
        if (!$guardian) {
            return redirect()->route('scan.page')->with('scan_error', 'Data wali tidak ditemukan.');
        }
        if ($students->isEmpty()) {
            return redirect()->route('scan.page')->with('scan_error', 'Wali murid ini belum memiliki data anak yang tertaut.');
        }

        $scanned_qr_data = $identifier;
        foreach ($students as $student) {
            PickupHistory::firstOrCreate(
                [
                    'date' => date('Y-m-d'),
                    'student_id' => $student->id,
                    'guardian_id' => $guardian->id
                ],
                [
                    'type' => 'pickup',
                    'start_at' => now(),
                    'qr_token' => $scanned_qr_data,
                ],
            );
        }
        return view('guardian.scan_confirm', compact('students', 'guardian', 'scanned_qr_data'));
    }

    public function submitConfirmation(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {

                $date = Carbon::parse($request->input('timestamp'))->format('Y-m-d');
                $guardianId = $request->input('guardian_id');
                $studentIds = $request->input('student_ids');


                PickupHistory::where([
                    'date' => $date,
                    'guardian_id' => $guardianId
                ])->whereNotIn('student_id', $studentIds)->delete();

                foreach ($studentIds as $studentId) {
                    PickupHistory::updateOrCreate(
                        [
                            'date' => $date,
                            'student_id' => $studentId,
                        ],
                        [
                            'end_at' => now(),
                            'type' => 'pickup',
                        ]
                    );
                }
            });
            return redirect()->route('scan.page')->with('scan_success', 'Kehadiran berhasil dicatat!');
        } catch (\Throwable $th) {
            return redirect()->route('scan.showConfirmation', ['qr_code' => $request->input('scanned_qr_data')])
                ->with('scan_error', 'Gagal mencatat kehadiran. Coba lagi.')
                ->withInput(); // Kirim kembali input sebelumnya
        }
    }
}
