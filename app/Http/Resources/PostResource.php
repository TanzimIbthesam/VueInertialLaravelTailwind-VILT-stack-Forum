<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image'=>$this->image,
            'slug'=>$this->slug,
            'user_id'=>$this->user_id,
            'category_id'=>$this->category_id,
            'user'=>new UserResource($this->user),
            'category'=>new CategoryResource($this->category),
            'comments'=>CommentResource::collection($this->comments),
            'links'=>''


        ];
    }
}
