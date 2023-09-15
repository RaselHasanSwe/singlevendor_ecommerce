<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Color;
use App\Models\InnerCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductShipping;
use App\Models\ProductSize;
use App\Models\ProductVariation;
use App\Models\Shipping;
use App\Models\Size;
use App\Models\SubCategory;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['data'] = Product::when($request->key, function($query) use($request){
            $query->where(function($query) use($request){
                $query->where('name', 'LIKE', "%{$request->key}%");
                $query->orwhere('sku', 'LIKE', "%{$request->key}%");
                $query->orwhere('stock', 'LIKE', "%{$request->key}%");
                $query->orwhere('price', 'LIKE', "%{$request->key}%");
                $query->orwhere('discount', 'LIKE', "%{$request->key}%");
            });
        })
        ->when(isset($request->status), function($query) use($request){
            $query->where('status', $request->status);
        })
        ->when($request->category_id, function($query) use($request){
            $query->where('category_id', $request->category_id);
        })
        ->when($request->sub_category_id, function($query) use($request){
            $query->where('sub_category_id', $request->sub_category_id);
        })
        ->when($request->inner_category_id, function($query) use($request){
            $query->where('inner_category_id', $request->inner_category_id);
        })->latest()->paginate(15);
        $data['category'] = Category::latest()->get();
        if($request->category_id) $data['sub_category'] = SubCategory::where('category_id', $request->category_id)->latest()->get();
        if($request->category_id) $data['inner_category'] = InnerCategory::where('category_id', $request->category_id)->latest()->get();


        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::latest()->get();
        $data['color'] = Color::latest()->get();
        $data['size'] = Size::latest()->get();
        $data['shipping'] = Shipping::get();
        $data['admin'] = Admin::first();
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlugService $slug,  ImageService $image, Request $request)
    {
        $data = $request->all();
        $data['slug'] = $slug->create($request->name);
        $data['hot'] = $request->has('hot_product') ? 1 : 0;
        $data['recomend'] = $request->has('recomend_product') ? 1 : 0;
        if($request->hasFile('main_image')) $data['thumbnail'] = $image->upload($request->main_image, 'product', ['small','medium']);
        $product = Product::create($data);
        $product_id = $product->id;

        if(isset($request->colors) && count($request->colors) > 0){
            $colors = [];
            foreach($request->colors as $color){
                $colorArr['product_id'] = $product_id;
                $colorArr['color_id'] = $color;
                $colors[] = $colorArr;
            }
            if(count($colors) > 0) ProductColor::insert($colors);
        }

        if(isset($request->sizes) && count($request->sizes) > 0){
            $sizes = [];
            foreach($request->sizes as $size){
                $sizeArr['product_id'] = $product_id;
                $sizeArr['size_id'] = $size;
                $sizes[] = $sizeArr;
            }
            if(count($sizes) > 0) ProductSize::insert($sizes);
        }

        if(isset($request->extra_image) && count($request->extra_image) > 0){
            $images = [];
            foreach($request->extra_image as $imageFile){
                $imgArr['product_id'] = $product_id;
                $imgArr['image'] = $image->upload($imageFile, 'product', ['small','medium']);
                $images[] = $imgArr;
            }
            if(count($images) > 0) ProductImage::insert($images);
        }

        if(isset($request->variation_price) && count($request->variation_price) > 0){
            $product_variations = [];
            foreach ($request->variation_price as $key => $price) {
                if(!$price) continue;
                $varArr['product_id'] = $product_id;
                $varArr['color_id'] = $request->variation_color[$key];
                $varArr['size_id'] =  $request->variation_size[$key];
                $varArr['price'] = $price;
                if($request->variation_image !=null && array_key_exists($key, $request->variation_image)){
                    $varArr['image'] = $image->upload($request->variation_image[$key], 'product', ['small','medium']);
                }
                $product_variations[] = $varArr;
            }
            if(count($product_variations) > 0) ProductVariation::insert($product_variations);
        }

        $this->saveShipping($request, $product_id);

        return redirect()->route('admin.product.index')->with('success', "Product Successfully Created");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = Product::where('id', $id)->with('images','variations.color','variations.size','shipping')->firstOrFail();
        $data['category'] = Category::latest()->get();
        $data['sub_category'] = $data['data']->sub_category_id ? SubCategory::where('id', $data['data']->sub_category_id)->get() : [];
        $data['inner_category'] = $data['data']->inner_category_id ? InnerCategory::where('id', $data['data']->inner_category_id)->get() : [];
        $data['color'] = Color::latest()->get();
        $data['size'] = Size::latest()->get();
        $data['selected_color'] = ProductColor::where('product_id', $id)->pluck('color_id')->toArray();
        $data['selected_size'] = ProductSize::where('product_id', $id)->pluck('size_id')->toArray();
        $modifyColorSize = $this->colorSize($data['data']);
        $data['color_size'] = $modifyColorSize['color_size'];
        $data['color_size_price'] = $modifyColorSize['color_size_price'];
        $data['color_size_image'] = $modifyColorSize['color_size_image'];
        $data['shipping'] = Shipping::get();
        $data['admin'] = Admin::first();
        //dd($data['selected_shipping']);

        //dd($data['data']->toArray());
        return view('admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlugService $slug, ImageService $image, Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['slug'] = $slug->edit($request->name, $product->slug);
        if($request->hasFile('main_image')){
            $image->delete($product->thumbnail);
            $data['thumbnail'] = $image->upload($request->main_image, 'product',['small','medium']);
        }
        $data['hot'] = $request->has('hot_product') ? 1 : 0;
        $data['recomend'] = $request->has('recomend_product') ? 1 : 0;
        $product->update($data);
        $product_id = $id;

        ProductColor::where('product_id', $id)->delete();
        if(isset($request->colors) && count($request->colors) > 0){
            $colors = [];
            foreach($request->colors as $color){
                $colorArr['product_id'] = $product_id;
                $colorArr['color_id'] = $color;
                $colors[] = $colorArr;
            }
            if(count($colors) > 0) ProductColor::insert($colors);
        }
        ProductSize::where('product_id', $id)->delete();
        if(isset($request->sizes) && count($request->sizes) > 0){
            $sizes = [];
            foreach($request->sizes as $size){
                $sizeArr['product_id'] = $product_id;
                $sizeArr['size_id'] = $size;
                $sizes[] = $sizeArr;
            }
            if(count($sizes) > 0) ProductSize::insert($sizes);
        }


        if(isset($request->extra_image) && count($request->extra_image) > 0){
            $images = [];
            foreach($request->extra_image as $imgKey => $imageFile){
                if($request->extra_image_id[$imgKey] !== null){
                    $getDBItem = ProductImage::find($request->extra_image_id[$imgKey]);
                    $image->delete($getDBItem->image);
                    $getDBItem->image = $image->upload($imageFile, 'product',['small','medium']);
                    $getDBItem->save();
                }else{
                    $imgArr['product_id'] = $product_id;
                    $imgArr['image'] = $image->upload($imageFile, 'product',['small','medium']);
                    $images[] = $imgArr;
                }
            }
            if(count($images) > 0) ProductImage::insert($images);
        }

        if(isset($request->variation_price) && count($request->variation_price) > 0){
            $product_variations = [];
            foreach ($request->variation_price as $key => $price) {
                if(!$price) continue;

                $findVariation = ProductVariation::where('color_id', $request->variation_color[$key])
                    ->where('size_id', $request->variation_size[$key])
                    ->where('product_id', $product_id)->first();
                if($findVariation){
                    if($request->variation_image != null && array_key_exists($key, $request->variation_image)){
                        $image->delete($findVariation->image);
                        $findVariation->image = $image->upload($request->variation_image[$key], 'product', ['small','medium']);
                    }
                    $findVariation->price = $price;
                    $findVariation->save();
                    $product_variations[] = $findVariation->id;
                }else{
                    $varArr['product_id'] = $product_id;
                    $varArr['color_id'] = $request->variation_color[$key];
                    $varArr['size_id'] =  $request->variation_size[$key];
                    $varArr['price'] = $price;
                    if($request->variation_image !=null && array_key_exists($key, $request->variation_image)){
                        $varArr['image'] = $image->upload($request->variation_image[$key], 'product');
                    }
                    $saveVari = ProductVariation::create($varArr);
                    $product_variations[] = $saveVari->id;
                }
            }
            if(count($product_variations) > 0)
                ProductVariation::where('product_id', $product_id)->whereNotIn('id',$product_variations)->delete();
        }

        ProductShipping::where('product_id', $id)->delete();
        $this->saveShipping($request, $id);

        return redirect()->route('admin.product.index')->with('success', "Product Successfully Updated");
    }

    public function saveShipping(Request $request, $poduct_id)
    {
        $shipping = Shipping::get();
        $free_shipping_id = [];
        foreach ($shipping as $key => $item) {
            if($request->has('shipping_is_free-'.$item->id)){
                $ship = new ProductShipping();
                $ship->shipping_id  = $item->id;
                $ship->product_id = $poduct_id;
                $ship->price = null;
                $ship->shipping_apply = null;
                $ship->is_free = 1;
                $ship->save();
                $free_shipping_id[] = $item->id;
            }
        }

        if(isset($request->shipping_price) && count($request->shipping_price) > 0){
            foreach ($request->shipping_price as $key => $value) {
                $shippingId = $request->shipping_id[$key];
                if(!in_array($shippingId, $free_shipping_id)){
                    $ship = new ProductShipping();
                    $ship->shipping_id  = $shippingId;
                    $ship->	product_id = $poduct_id;
                    $ship->price = $value;
                    $ship->shipping_apply = $request->shipping_apply[$key];
                    $ship->save();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageService $image, SlugService $slug, $id)
    {
        $data = Product::where('id', $id)->with('images','variations')->firstOrFail();
        $this->deleteProductImage($data);
        $this->deleteProductVariationImage($data);
        $image->delete($data->thumbnail);
        $slug->delete($data->slug);

        ProductColor::where('product_id', $id)->delete();
        ProductSize::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();
        ProductVariation::where('product_id', $id)->delete();
        $data->delete();
        return redirect()->back()->with('Success','Product Successfully Deleted');
    }

    protected function deleteProductImage($data)
    {
        if(count($data->images) > 0){
            $image = new ImageService;
            foreach ($data->images as $itemImage) {
                if($itemImage->image) $image->delete($itemImage->image);
            }
        }
    }

    protected function deleteProductVariationImage($data)
    {
        if(count($data->variations) > 0){
            $image = new ImageService;
            foreach ($data->variations as $itemVari) {
                if($itemVari->image) $image->delete($itemVari->image);
            }
        }
    }

    public function colorSize($data)
    {
        $color_size = [];
        $color_size_price = [];
        $color_size_image = [];
        if(count($data->variations) > 0){
            foreach($data->variations as $item){
                $color_size[] = $item->color_id.'-'.$item->size_id;
                $color_size_price[] = $item->price;
                $color_size_image[] = asset(ImageService::show($item->image, 'sm-'));
            }
        }
        return ['color_size' => $color_size, 'color_size_price' => $color_size_price, 'color_size_image' =>$color_size_image];
    }

    public function deleteAditionlImage(ImageService $image, Request $request)
    {
        $data = ProductImage::findOrFail($request->id);
        $image->delete($data->image);
        $data->delete();
        return 'Image Successfully Deleted';
    }

    public function active(Request $request)
    {
        $data = Product::findOrFail($request->id);
        $data->status = $data->status == 1 ? 0 : 1;
        $message = $data->status == 1 ? 'Product Successfully Actived' : 'Product Successfully Inactived';
        $data->save();
        return $message;
    }
}
