<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="slider-wrapper-area">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @if(count($slider) > 0)
                            @foreach ($slider as $key => $item)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        @endif
                    </ol>
                    <div class="carousel-inner">
                        @if(count($slider) > 0)
                            @foreach ($slider as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ ImageViewer::show($item->image) }}" alt="{{ $key }} slide">
                                    @if($item->title || $item->button_name || $item->description)
                                    <div class="carousel-caption d-none d-md-block">
                                        @if($item->title)
                                            <h5 class="slider_title">{{ $item->title }}</h5>
                                        @endif
                                        @if($item->description)
                                            <p class="slider_description">{{ $item->description }}</p>
                                        @endif
                                        @if($item->button_name)
                                            <a href="{{ $item->button_url }}" class="btn btn-danger slider_button">{{ $item->button_name }}</a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
