@extends('layouts.master')

@section('title')

 Laravel Shopping Cart

@endsection

@section('content')
  @if(Session::has('success'))
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-mm-offset-3">
       <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}
       </div>
    </div>
  </div>
@endif
  @foreach ($products->chunk(3) as $productChunk)
    {{-- mathi ko foreach le chai aaota row ma 3 ota products rakna milx --}}
    <div class="row">
      @foreach ($productChunk as $products)
        {{-- ani yo foreach loop le chai column ma product rakhx --}}
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="{{ $products->imagePath }}" alt="..." class="img-responsive">
            <div class="caption">
              <h3>{{ $products->title }}</h3>
              <p class="description">{{ $products->description }}</p>
              <div class="clearfix">
                <div class="pull-left price">Rs
                   {{ $products->price }}
                </div>
                 <a href="{{ route('product.addToCart', ['id' => $products->id]) }}"
                   class="btn btn-success pull-right" role="button">Add to Cart
                 </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach

@endsection
