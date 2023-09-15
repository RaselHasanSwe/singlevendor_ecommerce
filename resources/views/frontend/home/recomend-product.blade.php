<div class="row mt-5">
    <div class="col-sm-12">
        <div class="section-title mb-30">
            <div class="title-icon">
                <i class="fa fa-gift"></i>
            </div>
            <h3>Product For You</h3>
            <a href="{{ url('/shop') }}" class="btn btn-danger float-right">View More</a>
        </div>
    </div>
    @foreach($recomended_products as $item)
        @include('frontend.__pertials.product-sm-card')
    @endforeach
</div>
