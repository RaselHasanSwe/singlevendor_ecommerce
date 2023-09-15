<?php

namespace App\Services;

use App\Models\Slug;
use Illuminate\Support\Str;

class SlugService{

    public function create( string $name )
    {
        $newSlug = Str::slug($name);
        $hasSlug = Slug::where('slug', $newSlug)->count();
        if($hasSlug > 0) $newSlug = $newSlug.'-'.$hasSlug + 1;
        Slug::create(['slug'=> $newSlug]);
        return $newSlug;
    }

    public function edit( string $name, string $oldSlug )
    {
        $newSlug = Str::slug($name);
        $existingSlug = Slug::where('slug', $oldSlug)->first();
        if($existingSlug){
            $hasSlug = Slug::where('slug', $newSlug)->where('id', '!=', $existingSlug->id)->count();
            if($hasSlug > 0) $newSlug .= $newSlug.'-'.$hasSlug + 1;
            $existingSlug->slug = $newSlug;
            $existingSlug->save();
            return $newSlug;
        }
        return $this->create($name);
    }

    public function delete( string $slug )
    {
        Slug::where('slug',$slug)->delete();
    }
}
