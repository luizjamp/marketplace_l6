@extends('layouts.front')


@section('content')
    <div class="row front">

            <div class="col-4">
                @if($store->logo)
                    <img src="{{asset('storage/' . $store->logo)}}" alt="logo da Loja {{$store->name}}" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/450x100.png?text=logo" alt="Loja sem logo..." class="img-fluid">
                @endif
            </div>
            <div class="col-8">
                <h2>{{$store->name}}</h2>
                <p>{{$store->description}}</p>
                <p>
                <h4>Contatos</h4>
                <spam>{{$store->phone}}</spam> |  <spam>{{$store->mobile_phone}}</spam>
                </p>
            </div>


        <div class="col-12">
            <hr>
            <h3 style="margin-bottom: 30px">Produtos desta Loja</h3>
        </div>
        @forelse($store->products as $key => $product)
                <div class="col-md-4">
                    <div class="card" style="width: 98%;">
                        @if($product->photos->count())
                            <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{$product->name}}</h2>
                            <p class="card-text">{{$product->description}}</p>
                            <h3>
                                R$ {{number_format($product->price,'2',',','.')}}
                            </h3>
                            <a href="{{route('product.single',['slug' => $product->slug])}}" class="btn btn-success">Ver Produto</a>
                        </div>
                    </div>
                </div>
                @if(($key+1) % 3 == 0) </div><div class="row front"> @endif
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum produto encontrado para esta Loja</h3>
            </div>
        @endforelse
    </div>
@endsection

