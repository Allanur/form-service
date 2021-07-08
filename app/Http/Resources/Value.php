<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Value extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'value'   => $this->value,
            'goto_id' => $this->goto_id,
        ];
    }
}
