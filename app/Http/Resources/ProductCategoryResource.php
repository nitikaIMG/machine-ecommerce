<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cover_image = $this->cover_image
            ? storage_url($this->cover_image)
            : sample_img(1920, 1050, $this->title ?? '');

        $parent = $this->relationLoaded('parent') && $this->parent
            ? ['id' => $this->parent->id, 'title' => $this->parent->title]
            : false;

        $children = $this->relationLoaded('children')
            ? self::collection($this->children)
            : false;

        $shops = $this->relationLoaded('shops')
            ? $this->shops->map->only(['id', 'shop_name'])->toArray()
            : false;

        return \array_merge([
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'cover_image' => $cover_image,
            // don't do new self($this->parent) -- recursion can leads to infinite loop
            $this->mergeWhen($parent !== false, [
                'parent' => $parent
            ]),
            $this->mergeWhen($children !== false, [
                'children' => $children
            ]),
            // shops that are selling in this category
            $this->mergeWhen($shops !== false, [
                'shops' => $shops
            ]),
        ], $this->additional);
    }
}
