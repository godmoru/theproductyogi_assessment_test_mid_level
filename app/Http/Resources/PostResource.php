<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'post body' => $this->post,
            'Posted By' => UserResource::collection($this->whenLoaded("users")),//$this->user,
            'Comments' => PostCommentResource::collection($this->whenLoaded("comments")),//$this->comments,
            'Date created' => $this->created_at
        ];
    }
}
