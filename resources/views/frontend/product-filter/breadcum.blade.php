 <!-- breadcrumb area start -->
 <div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            @if($all_categories !== null)
                                @if($all_categories)
                                    <li class="breadcrumb-item"><a href="{{ Str::URI('shop/'.$all_categories->slug) }}">{{ $all_categories->name }}</a></li>
                                @endif

                                @if(count($all_categories->subCategory) > 0)
                                    <li class="breadcrumb-item"><a href="{{ Str::URI('shop/'.$all_categories->slug, $all_categories->subCategory[0]->slug) }}">{{ $all_categories->subCategory[0]->name }}</a></li>
                                    @if(array_key_exists('inner_category', $all_categories->subCategory[0]->toArray()))

                                        <li class="breadcrumb-item"><a href="{{ Str::URI('shop/'.$all_categories->slug, $all_categories->subCategory[0]->slug, $all_categories->subCategory[0]->innerCategory[0]->slug) }}">{{ $all_categories->subCategory[0]->innerCategory[0]->name }}</a></li>
                                    @endif
                                @endif
                            @else
                                <li class="breadcrumb-item">Shop</li>
                                @if(request()->key)
                                    <li class="breadcrumb-item">{{ request()->key }}</li>
                                @endif
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
