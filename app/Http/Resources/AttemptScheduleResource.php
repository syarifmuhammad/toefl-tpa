<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'schedule' => [
                'id' => $this->schedule->id,
                'tanggal' => $this->schedule->tanggal,
            ],
            'payment' => [
                'payment_type' => $this->payment_type,
                'biaya' => $this->schedule->biaya,
            ],
            'status' => $this->status,
        ];
    }
}
