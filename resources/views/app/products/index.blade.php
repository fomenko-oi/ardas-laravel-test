@extends('layouts.admin')

@php /** @var \App\Entity\Product[] $products */ @endphp

@section('content')

    <div class="row">

        <form class="col-md-6 offset-md-3" action="{{ route('products.index') }}">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                </div>

                <div class="col">
                    <input class="form-control form-control-borderless" name="q" type="search" placeholder="Search by product name" value="{{ $query }}">
                </div>

                <div class="col-auto">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="col-md-2 offset-md-1 card-body row no-gutters align-items-center">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        </div>

    </div>

    <table class="table">
        @if($products->count() === 0)

            <tr class="table-warning">
                <td colspan="4" class="text-center">
                    {{ !empty($query) ? 'No products were found.' : 'No products has been created.' }}
                </td>
            </tr>

        @else
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>

                @foreach($products as $product)

                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->created_at->format('d.m.Y G:i') }}</td>
                        <td width="15%">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-success">Edit</a>
                                </li>

                                <li class="list-inline-item">

                                    <form action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Delete">Delete</button>
                                    </form>

                                </li>
                            </ul>

                        </td>
                    </tr>

                @endforeach

                <tr>
                    <td colspan="4">{!! $products->appends(['q' => $query])->links() !!}</td>
                </tr>

            </tbody>
        @endif
    </table>
@endsection
