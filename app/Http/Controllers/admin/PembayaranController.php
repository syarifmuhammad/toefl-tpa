<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttemptScheduleResource;
use App\Models\AttemptSchedule;
use App\Models\BuktiPembayaranPendaftaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $registrars = AttemptSchedule::with(['schedule', 'user']);
        if ($request->has('status') && $request->status != 'semua') {
            $status = 0;
            switch ($request->status) {
                case 'proses':
                    $status = 0;
                    break;
                case 'selesai':
                    $status = 1;
                    break;
                case 'dibatalkan':
                    $status = 2;
                    break;
            }
            $registrars->where('status', $status);
        }

        return Inertia::render('Admin/Pembayaran/Index', [
            'registrars' => AttemptScheduleResource::collection($registrars->paginate(100)),
            'status' => $request->has('status') ? $request->status : 'semua',
        ]);
    }

    public function detail($id)
    {
        $registrar = AttemptSchedule::with(['schedule', 'user', 'bukti_pembayaran'])->find($id);
        return Inertia::render('Admin/Pembayaran/Detail', [
            'registrar' => new AttemptScheduleResource($registrar),
        ]);
    }

    public function update(Request $request, $id)
    {
        $registrar = AttemptSchedule::find($id);

        try {
            DB::beginTransaction();
            if ($request->status == 1) {
                $bukti_pembayaran = new BuktiPembayaranPendaftaran();
                $bukti_pembayaran->id = $id;
                $bukti_pembayaran->file = $request->file('file')->store('bukti_pembayaran_pendaftaran', 'public');
                $bukti_pembayaran->save();
            } else {
                $bukti_pembayaran = BuktiPembayaranPendaftaran::find($id);
                if ($bukti_pembayaran) {
                    if (Storage::disk('public')->exists($bukti_pembayaran->file)) {
                        Storage::disk('public')->delete($bukti_pembayaran->file);
                    }
                    $bukti_pembayaran->delete();

                }
            }

            $registrar->status = $request['status'];
            $registrar->save();
            DB::commit();
            return redirect()->route('admin.pembayaran.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.pembayaran.detail', $id);;
        }
    }
}
