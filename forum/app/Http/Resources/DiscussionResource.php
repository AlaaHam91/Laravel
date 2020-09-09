<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
           "user"=>$this->user,
           "channel"=>$this->channel,
           "title"=>$this->title,
           "content"=>$this->content,
           "slug"=>$this->slug,
           "id"=>$this->id,
           "created_at"=>$this->created_at,
           "updated_at"=>$this->updated_at,
           "published_at"=>$this->created_at->diffForHumans(),
           "replies_count"=>$this->replies->count(),
           "replies"=>ReplayResource::collection($this->replies)
        ];
    }
}
