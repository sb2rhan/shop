@props(['title' => null, 'showCategories' => false])

<x-layouts.base :title="$title" {{ $attributes }}>
    <x-partials.navbar>

        <x-partials.navbar.link href="{{ url('/') }}">
            {{__('Home')}}
        </x-partials.navbar.link>

        <x-partials.navbar.link href="{{ route('products.index') }}">
            {{__('Products')}}
        </x-partials.navbar.link>

        @auth
            <x-slot name="userBar">
                <x-partials.navbar.link href="{{ route('cart.index') }}">
                    {{ __('Cart') }}
                    <span class="badge bg-secondary">
                        {{ auth()->user()->cart_count }}
                    </span>
                </x-partials.navbar.link>
            </x-slot>
        @endauth

    </x-partials.navbar>

    <div class="container mt-3">
        <div class="row">
            @if($showCategories)
            <div class="col-3">
                <div class="card">

                    <div class="card-header">
                        {{ __('Categories') }}
                    </div>

                    <div class="list-group list-group-flush">
                        @foreach(App\Models\Category::query()->orderBy('name')->get() as $category)
                            <a href="{{ route('categories.show', $category) }}" class="list-group-item list-group-item-action">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.base>
