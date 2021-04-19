<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'name' => $this->when($this->name, $this->name),
            'amount' => $this->amount,
            'month' => $this->month,
            'year' => $this->year,
            'date' => $this->date,
        ];
    }
}
