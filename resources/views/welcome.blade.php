@extends('layouts.master')

@section('content')

{{-- If you're looking for the banners, go to elements/banners.blade.php --}}

{{-- Product carousel --> START Commented out till phase 2
<div class="page-home">
  <div class="container-fluid text-center vpad-60" id="home-freshbaskets">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="has-subheading">{{ $homepage_text['products_title'] }}</h1>
          <p>{{ $homepage_text['products_description'] }}</p>
          <div class="owl-carousel full-width-carousel" id="carouselFreshBaskets">
            @foreach ($latest_products as $product)
              @php
                $brand = Features::getBrand($product->brand_id);
              @endphp
              <div class="product">
                <a href="{{ URL::route('products', array('title' => $product->slug )) }}">
                  <img src="{{  url('/') }}/{{$product->image}}" class="img-responsive">
                  @if ($brand != null)
                  <p><strong>{{ $brand->name }}</strong></p>
                  @endif
                  <p>{{$product->title}}</p>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>            
  </div>
  END of comment
--}}

  {{-- Inspiration categories --}}
  <div class="container-fluid vpad-30 bg-full-image" id="home-inspirations">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-6 pull-right">
                <img src="{{ URL::to('images/recipes-cover.png') }}" class="img-responsive">
              </div>
              <div class="col-xs-12 col-sm-6 center-absolute">
                <h2 class="hidden-xs">{{ $homepage_text['recipes_title'] }}</h2>
                <p class="hidden-xs">{{ $homepage_text['recipes_description'] }}</p>
                <br>
                <div class="">
                    <h4 class="text-primary">Browse recipes 
                    by category</h4>
                    <div class="inspiration-links">
                      @foreach ($recipe_tags as $recipe_tag)
                      <a class="btn btn-hollow" href="{{ URL::route('recipes-tag', array('title' => $recipe_tag->slug )) }}">{{$recipe_tag->name}}</a>
                      @endforeach
                    </div>
              </div>            
                <a href="{{ URL::route('recipes', array('title' => '' )) }}" class="btn btn-primary">View All Recipes</a>
              </div>
          </div>
        </div>
    </div>

  {{-- Product categories aka Shelves --> START Commented out till phase 2
  <div class="container-fluid vpad-60 text-center" id="home-categories">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h2>Shelves</h2>
          </div>
        </div>
        <div class="row">
          @foreach ($featured_products_categories as $product)
            <a href="{{ URL::route('products-category', array('title' => $product->slug )) }}" class="category-wrap-link">
              <div class="col-xs-6 col-md-3 bg-full-image category-bg">
                  <div class="center-absolute category-name">
                  <span class="center-absolute">{{$product->name}}</span>
                  </div>            
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  END of comment
  --}}
  {{-- Articles aka Journal --}}
  <div class="container-fluid text-center vpad-60" id="home-journal">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h2>{{ $homepage_text['articles_title'] }}</h2>   
            <p>{{ $homepage_text['articles_description'] }}</p>       
          </div>
        </div>
        <div class="row masonry-journal">
          @for ($i = 0 ; $i < count($latest_articles); $i++)
            <div class="masonry-item masonry-sizer @if ($i>0) hidden-xs @endif">
              <div class="panel">
                  <div class="panel-heading">
                    <img src="{{  url('/') }}/{{$latest_articles[$i]->thumbnail}}" class="img-responsive">
                  </div>
                  <div class="panel-body">
                    <p><strong>{{$latest_articles[$i]->title}}</strong></p>

                    @php
                      $description = strip_tags($latest_articles[$i]->content);
                      $description = substr($description, 0, 160);
                    @endphp

                    <p>{{ $description }}...</p>
                    <a href="{{ URL::route('articles', array('title' => $latest_articles[$i]->slug )) }}" class="btn btn-secondary btn">Read More</a>
                  </div>
              </div>
            </div>
          @endfor
        </div>
        <div class="row">
          <div class="col-xs-12">
            <a href="{{ URL::route('articles', array('title' => '' )) }}" class="btn btn-primary">View All Articles</a>
          </div>
        </div>
      </div>
    </div>  
  </div>

@endsection

{{-- Footer is included after this --}}