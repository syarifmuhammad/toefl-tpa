<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttemptScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $date = Carbon::createFromFormat('Y-m-d', $user->premiumDate);
        return [
            'id' => $this->id,
            'questionbank' => [
                'category' => $this->schedule->questionbank->category,
            ],
            'schedule' => [
                'id' => $this->schedule->id,
                'tanggal' => $this->schedule->tanggal,
                'status' => $this->status,
            ],
            'payment' => [
                'payment_id' => strtoupper($this->schedule->questionbank->category) . '-' . str_pad($this->id, 3, '0', STR_PAD_LEFT) . '-ITTS',
                'payment_type' => $this->payment_type,
                'biaya' => $this->schedule->biaya,
            ],
            'user' => [
                'nim_or_nik' => $this->user->nim_or_nik,
                'name' => $this->user->name,
            ],
            'bukti_pembayaran' => [
                'file' => $this->bukti_pembayaran ? Storage::url($this->bukti_pembayaran->file) : null,
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
