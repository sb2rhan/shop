<x-layouts.app :title="__('Products')" :showCategories="true">
    @if($products->isEmpty())
        <div class="alert alert-secondary">
            {{ __('There are no products') }}
        </div>

    @else
        <div class="row row-cols-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100">
                        @if($product->category)
                            <div class="card-header">
                                {{ $product->category->name }}
                            </div>
                        @else
                            {{ __('Without category') }}
                        @endif

                        <div class="list-group list-group-flush h-100">
                            <a href="{{ route('products.show', $product) }}"
                               class="h-100 p-3 list-group-item list-group-item-action">
                                <h5 class="card-title">
                                    {{ $product->name }}
                                </h5>
                                @if($product->description)
                                    <div>
                                        {{ $product->description }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-3">
            {{ $products->links() }}
        </div>

    @endif
</x-layouts.app>
