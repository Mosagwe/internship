<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'users'=>UserResource::collection($this->users),
            'created_at'=>$this->created_at->format('d-M-Y'),
            'updated_at'=>$this->updated_at->format('d-M-Y')
        ];
    }
}
