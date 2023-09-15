<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\InnerCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index(Request $request, $cat_slug = null, $sub_cat_slug = null, $inner_cat_slug = null)
    {
        if($inner_cat_slug !==  null){
            $inner_category = InnerCategory::where('slug', $inner_cat_slug)->firstOrFail();

            $get_min_max_price = $this->priceModifier($request);
            $min_price = $get_min_max_price['min_price'];
            $max_price = $get_min_max_price['max_price'];

            $get_sort_by = $this->sortByMidifier($request);
            $sort_by_name = $get_sort_by['sort_by_name'];
            $sort_by_value = $get_sort_by['sort_by_value'];


            $data['products'] = $this->getProducts($request, 'inner_category_id', $inner_category->id, $min_price, $max_price, $sort_by_name, $sort_by_value);

            if($request->ajax()){
                $html_product = view('frontend.product-filter.products', $data)->render();
                return response()->json(['products' => $html_product]);
            }

            // filter cateogory data
            $inner_category_list = InnerCategory::where('sub_category_id', $inner_category->sub_category_id)
                ->pluck('id')->toArray();
            $data['filter_categories'] = InnerCategory::whereIn('id', $inner_category_list)->with('subCategory','category')->withCount('product')->get();

            // filter brand data
            $data['filter_brands'] = $this->getBrands('inner_category_id', $inner_category->id);

            // filter price data
            $data['filter_max_price'] = Product::where('inner_category_id', $inner_category->id)->max('price');
            $data['filter_min_price'] = Product::where('inner_category_id', $inner_category->id)->min('price');
            $data['filter_price_list'] = $this->makePriceRange($data['filter_min_price'], $data['filter_max_price']);

            $getColorSizes = $this->getColorAndSize('inner_category_id', $inner_category->id);
            $data['filter_colors'] = $getColorSizes['filter_colors'];
            $data['filter_sizes'] = $getColorSizes['filter_sizes'];

        }else if($sub_cat_slug !== null && $inner_cat_slug ===  null){

            $sub_category = SubCategory::where('slug', $sub_cat_slug)->firstOrFail();

            $get_min_max_price = $this->priceModifier($request);
            $min_price = $get_min_max_price['min_price'];
            $max_price = $get_min_max_price['max_price'];

            $get_sort_by = $this->sortByMidifier($request);
            $sort_by_name = $get_sort_by['sort_by_name'];
            $sort_by_value = $get_sort_by['sort_by_value'];
            $data['products'] = $this->getProducts($request, 'sub_category_id', $sub_category->id, $min_price, $max_price, $sort_by_name, $sort_by_value);

            if($request->ajax()){
                $html_product = view('frontend.product-filter.products', $data)->render();
                return response()->json(['products' => $html_product]);
            }

            // filter cateogory data
            $sub_category_list = SubCategory::where('category_id', $sub_category->category_id)
                ->pluck('id')->toArray();
            $data['filter_categories'] = SubCategory::whereIn('id', $sub_category_list)->with('category')->withCount('product')->get();

            // filter brand data
            $data['filter_brands'] = $this->getBrands('sub_category_id', $sub_category->id);

            // filter price data
            $data['filter_max_price'] = Product::where('sub_category_id', $sub_category->id)->max('price');
            $data['filter_min_price'] = Product::where('sub_category_id', $sub_category->id)->min('price');
            $data['filter_price_list'] = $this->makePriceRange($data['filter_min_price'], $data['filter_max_price']);
            //dd($data['filter_min_price']);

            $getColorSizes = $this->getColorAndSize('sub_category_id', $sub_category->id);
            $data['filter_colors'] = $getColorSizes['filter_colors'];
            $data['filter_sizes'] = $getColorSizes['filter_sizes'];

        }else if($cat_slug !== null && $inner_cat_slug ===  null && $sub_cat_slug === null){

            $category = Category::where('slug', $cat_slug)->firstOrFail();

            $get_min_max_price = $this->priceModifier($request);
            $min_price = $get_min_max_price['min_price'];
            $max_price = $get_min_max_price['max_price'];

            $get_sort_by = $this->sortByMidifier($request);
            $sort_by_name = $get_sort_by['sort_by_name'];
            $sort_by_value = $get_sort_by['sort_by_value'];
            $data['products'] = $this->getProducts($request, 'category_id', $category->id, $min_price, $max_price, $sort_by_name, $sort_by_value);
            if($request->ajax()){
                $html_product = view('frontend.product-filter.products', $data)->render();
                return response()->json(['products' => $html_product]);
            }

            // filter cateogory data
            $data['filter_categories'] = Category::withCount('product')->get();

            // filter brand data
            $data['filter_brands'] = $this->getBrands('category_id', $category->id);

            // filter price data
            $data['filter_max_price'] = Product::where('category_id', $category->id)->max('price');
            $data['filter_min_price'] = Product::where('category_id', $category->id)->min('price');
            $data['filter_price_list'] = $this->makePriceRange($data['filter_min_price'], $data['filter_max_price']);

            // filter colors
            $getColorSizes = $this->getColorAndSize('category_id', $category->id);
            $data['filter_colors'] = $getColorSizes['filter_colors'];
            $data['filter_sizes'] = $getColorSizes['filter_sizes'];
        }
        //dd($data['filter_categories']->toArray());

        if($cat_slug == null && $sub_cat_slug == null && $inner_cat_slug == null){
            $get_min_max_price = $this->priceModifier($request);
            $min_price = $get_min_max_price['min_price'];
            $max_price = $get_min_max_price['max_price'];

            $get_sort_by = $this->sortByMidifier($request);
            $sort_by_name = $get_sort_by['sort_by_name'];
            $sort_by_value = $get_sort_by['sort_by_value'];


            $data['products'] = $this->getProducts($request, null, null, $min_price, $max_price, $sort_by_name, $sort_by_value);

            if($request->ajax()){
                $html_product = view('frontend.product-filter.products', $data)->render();
                return response()->json(['products' => $html_product]);
            }

            // filter cateogory data
            $data['filter_categories'] = Category::withCount('product')->get();

            // filter brand data
            $data['filter_brands'] = $this->getBrands(null, null, $request->key);

            // filter price data
            $data['filter_max_price'] = Product::when($request->key !='', function($query) use($request){
                $query->where(function($q1) use($request){
                    $q1->where('name', 'LIKE', "%{$request->key}%");
                });
            })->max('price');
            $data['filter_min_price'] = Product::when($request->key !='', function($query) use($request){
                $query->where(function($q1) use($request){
                    $q1->where('name', 'LIKE', "%{$request->key}%");
                });
            })->min('price');
            $data['filter_price_list'] = $this->makePriceRange($data['filter_min_price'], $data['filter_max_price']);

            // filter colors
            $getColorSizes = $this->getColorAndSize(null, null, $request->key);
            $data['filter_colors'] = $getColorSizes['filter_colors'];
            $data['filter_sizes'] = $getColorSizes['filter_sizes'];

        }

        $data['all_categories'] = Category::where('slug', $cat_slug)->when($sub_cat_slug !== null, function($query) use($sub_cat_slug, $inner_cat_slug){
            $query->with('subCategory', function($q1) use($sub_cat_slug, $inner_cat_slug){
                $q1->where('slug', $sub_cat_slug);
                $q1->when($inner_cat_slug !== null, function($q2) use($inner_cat_slug){
                    $q2->with('innerCategory', function($q3) use($inner_cat_slug){
                        $q3->where('slug', $inner_cat_slug);
                    });
                });
            });
        })->first();

        //dd($data['all_categories']->toArray());



        return view('frontend.product-filter.index', $data);
    }

    public function priceModifier( Request $request )
    {
        $min_price = null;
        $max_price = null;

        if($request->price_range){
            $priceArr = explode('-', $request->price_range);
            $min_price = trim(str_replace('$', '', $priceArr[0]));
            $max_price = trim(str_replace('$', '', $priceArr[1]));
        }
        return ['min_price' => $min_price, 'max_price' => $max_price];
    }

    public function sortByMidifier( Request $request)
    {
        $sort_by_name = 'price';
        $sort_by_value = $request->sort_by ?? 'asc';
        if($request->sort_by == 'name_asc'){
            $sort_by_name = 'name';
            $sort_by_value = 'asc';
        }else if($request->sort_by == 'name_desc'){
            $sort_by_name = 'name';
            $sort_by_value = 'desc';
        }
        return ['sort_by_name' => $sort_by_name, 'sort_by_value' => $sort_by_value];
    }

    public function getProducts($request, $cat_key, $cat_value, $min_price, $max_price, $sort_by_name, $sort_by_value)
    {
        return Product::when($cat_key !== null && $cat_value !== null, function($query) use($cat_key, $cat_value){
                $query->where($cat_key, $cat_value);
            })
            ->when($request->key !='', function($query) use($request){
                $query->where(function($q1) use($request){
                    $q1->where('name', 'LIKE', "%{$request->key}%");
                });
            })
            ->when(isset($request->brands) && count($request->brands) > 0, function($query) use($request){
                $query->whereIn('brand_id', $request->brands);
            })
            ->when($min_price !== null && $max_price !== null, function($query) use($min_price, $max_price){
                $query->whereBetween('price', [$min_price, $max_price]);
            })
            ->when(isset($request->sizes) && count($request->sizes) > 0, function($query) use($request){
                $query->whereHas('sizes', function($query1) use($request){
                    $query1->whereIn('size_id', $request->sizes);
                });
            })
            ->when(isset($request->colors) && count($request->colors) > 0, function($query) use($request){
                $query->whereHas('colors', function($query1) use($request){
                    $query1->whereIn('color_id', $request->colors);
                });
            })->with('sizes','colors')
            ->orderBy($sort_by_name, $sort_by_value)
            ->paginate(20);

    }

    public function getBrands($cat_key, $cat_value, $key = '')
    {
        $brand_list = Product::when($cat_key !== null && $cat_value !== null, function($query) use($cat_key, $cat_value){
            $query->where($cat_key, $cat_value);
        })
        ->when($key !='', function($query) use($key){
            $query->where(function($q1) use($key){
                $q1->where('name', 'LIKE', "%{$key}%");
            });
        })
        ->groupBy('brand_id')->pluck('brand_id')->toArray();
        return Brand::whereIn('id', $brand_list)->withCount('product')->get();
    }

    public function getColorAndSize($cat_key, $cat_value, $key = '')
    {
        $all_product_id_list = Product::when($cat_key !== null && $cat_value !== null, function($query) use($cat_key, $cat_value){
            $query->where($cat_key, $cat_value);
        })
        ->when($key !='', function($query) use($key){
            $query->where(function($q1) use($key){
                $q1->where('name', 'LIKE', "%{$key}%");
            });
        })
        ->pluck('id')->toArray();

        // filter colors
        $color_list = ProductColor::whereIntegerInRaw('product_id', $all_product_id_list)
        ->select('color_id')
        ->distinct()
        ->pluck('color_id')
        ->toArray();


        $filter_colors = Color::whereIn('id', $color_list)->get();


        $size_list = ProductSize::whereIntegerInRaw('product_id', $all_product_id_list)
        ->select('size_id')
        ->distinct()
        ->pluck('size_id')
        ->toArray();

        $filter_sizes = Size::whereIn('id', $size_list)->get();

        return ['filter_colors' => $filter_colors, 'filter_sizes' => $filter_sizes];
    }
    public function makePriceRange($min_price, $max_price)
    {
        $difference = $max_price - $min_price;
        if($difference < 10) return [];

        if($max_price < 10) return [];
        $per_price = ceil($max_price / 10);
        $data = [];
        for ($i=1; $i <= 10; $i++) {
            if($i == 1) {
                $data[$min_price] = $per_price;
            }else if($i == 10){
                $data[(($i - 1) * $per_price) + 1] = $max_price;
            }else{
                $data[(($i - 1) * $per_price) + 1] = $per_price * $i;
            }
        }
        return $data;
    }
}
