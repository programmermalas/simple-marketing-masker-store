@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

    <div class="row justify-content-center">
        @foreach (App\Models\Product::get() as $product)
        @if ( $product->stock > 0 )
        <div class="col-sm-12 col-md-6 col-lg-3 pt-3 pb-3 pt-md-0">
            <div class="card shadow-sm">
                <a href="{{ route('detail', $product->slug) }}" class="text-decoration-none text-reset">
                    <div class="py-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 240px; overflow: hidden;">
                            <img src="/storage/images/300/{{$product->productImage->name}}" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $product->productImage->name }}">
                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="card-title">{{ $product->title }}</h6>

                        <div class="card-text">
                            <span>Rp {{ number_format( $product->price_a, 0, '.', ',' ) }}</span> <br>
                            <span>Stock: {{ number_format( $product->stock, 0, '.', ',' ) }}</span>
                        </div>
                    </div>
                </a>

                <div class="card-footer">
                    <form action="{{ route('store', $product->slug) }}" method="post">
                        @csrf
                        
                        <div class="row d-flex justify-content-between">
                            <div class="col-sm-12 col-md-6">
                                <input name="quantity" type="number" class="form-control" id="quantity" min="5" step="5" value="5">
                            </div>
    
                            <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                                <button type="submit" class="btn btn-primary d-block w-100" style="white-space: nowrap;">Add to cart</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
