<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Property extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'type'   => $this->type,
            'values' => $this->when($this->values()->exists(), Value::collection($this->values)),
        ];
    }
}
