@extends('layouts.admin')

@php /** @var \App\Entity\Characteristic[] $characteristics */ @endphp

@section('content')

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

            @error('name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price" class="col-form-label">Price</label>
            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>

            @error('price')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="border p-3 mb-3">
            <label class="font-weight-bold">Characteristics</label>

            @foreach($characteristics as $characteristic)

                @include('app.products._characteristics.' . $characteristic->type, ['characteristic' => $characteristic, 'value' => old("characteristics.{$characteristic->id}")])

            @endforeach
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Create product">
        </div>

    </form>

@endsection
