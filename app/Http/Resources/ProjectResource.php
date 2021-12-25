<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array {
        return [
            "id" => $this->id,
            "username" => $this->user->name,
            "name" => $this->name,
            "description" => $this->description,
            "created_at" => $this->created_at,
        ];
    }
}
