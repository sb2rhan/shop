<x-layouts.app :title="$product->name">

    <h1>{{ $product->name }}</h1>

    <p class="lead">{{ $product->description }}</p>

    <div class="d-flex">
        <div class="fs-4 me-3">
            ${{ $product->calculate() }}
        </div>

        <form action="{{ route('cart.store', $product) }}" method="post">
            @csrf

            <button class="btn btn-primary">
                {{ __('Add to cart') }}
            </button>
        </form>
    </div>

</x-layouts.app>
