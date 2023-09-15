<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(Request $request, $slug1, $slug2 = null, $slug3 = null)
    {


        $data['product'] = Product::where('slug', $slug1)
            ->with(
                'category',
                'subCategory',
                'innerCategory',
                'images',
                'colors.color',
                'sizes.size',
                'variations.color',
                'variations.size'
            )
            ->firstOrFail();
        $related_products = [];
        $featured_products = [];
        if($data['product']){
            $related_products = $this->randormOrderProduct($data['product']);
            $featured_products = $this->randormOrderProduct($data['product']);
        }

        //dd($data['product']->toArray());

        $data['related_products'] = $related_products;
        $data['featured_products'] = $featured_products;

        return view('frontend.product-details.index', $data);
    }

    public function randormOrderProduct($product)
    {
        $data = [];

        if($product->inner_category_id){
            $data = Product::where('inner_category_id', $product->inner_category_id)
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        }else if($product->sub_category_id){
            $data = Product::where('sub_category_id', $product->sub_category_id)
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        }else{
            $data = Product::where('category_id', $product->category_id)
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        }

        return $data;
    }

    public function getVariationPrice(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        $variation = ProductVariation::where('product_id', $request->product_id)
            ->where('color_id', $request->color)
            ->where('size_id', $request->size)
            ->first();
        if($variation){
            $price = Str::VariationPrice($variation->price, $product);
            return response()->json(['price' => $price]);
        }

    }
}
