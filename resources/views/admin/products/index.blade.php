<x-layouts.admin :title="__('Products')">
    <x-slot name="toolbar">
        <a class="btn btn-success" href="{{ route('admin.products.create') }}">
            {{ __('Add product') }}
        </a>
    </x-slot>

    @if($products->isEmpty())
        <div class="alert alert-secondary">
            {{ __('No product added yet') }}.
            {{ __('Please,') }}
            <a class="alert-link" href="{{ route('admin.products.create') }}">
                add one
            </a>
        </div>

    @else

        @foreach($products as $product)
            <div class="card my-3">

                <div class="card-body d-flex">
                    <div>
                        <div class="fw-bold card-title">
                            {{ $product->name }}
                        </div>

                        {{ $product->description }}
                    </div>

                    <div class="text-secondary fs-4 ms-auto">
                        ${{ $product->calculate() }}
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center">

                    @if($product->category)
                        <a class="me-2" href="{{ route('admin.categories.show', $product->category) }}">
                            <span class="badge bg-secondary">
                                {{ $product->category->name }}
                            </span>
                        </a>
                    @endif

                    <small class="text-secondary me-auto">
                        {{ $product->created_at->diffForHumans() }}
                    </small>

                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm me-2 btn-primary">
                        {{ __('View') }}
                    </a>

                    <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                        @csrf @method('delete')

                        <div class="btn-group btn-group-sm me-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                                {{ __('Edit') }}
                            </a>

                            <button class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{ $products->links() }}

    @endif
</x-layouts.admin>
