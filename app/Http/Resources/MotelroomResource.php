<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotelroomResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'area' => $this->area,
            'address' => $this->address,
            'images' => $this->images,
            'latlng' => $this->latlng,
            'phone' => $this->phone,
            'approve' => $this->approve,
            'count_view' => $this->count_view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'user' => new UserResource($this->whenLoaded('user')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'reports' => ReportResource::collection($this->whenLoaded('reports')),
        ];
    }
} 