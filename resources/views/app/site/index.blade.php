@extends('layouts.admin')

@section('content')
    <section class="jumbotron text-center bg-light">
        <div class="container">
            <h1>Demo work</h1>
            <p>
                <a href="{{ route('products.index') }}" class="btn btn-primary my-2">Products</a>
                <a href="#" class="btn btn-secondary my-2">Characteristics</a>
            </p>
        </div>
    </section>
@endsection
