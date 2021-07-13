<x-layouts.app :title="__('Orders')">

    <h1>
        {{ __('Orders') }}
    </h1>

    <div class="row">
        <div class="col-8">
            @foreach($cart as $c)
                <div class="card my-3">

                    <div class="card-body d-flex align-items-start">
                        <div>
                            <div class="fw-bold card-title">
                                {{ $c->product->name }}
                            </div>

                            {{ $c->product->description }}
                        </div>

                        <div class="text-secondary fs-4 ms-auto d-flex align-items-center">
                            <span class="fs-6 me-2">
                                ${{ $c->product->calculate() }} &times; {{ $c->amount }}
                            </span>

                            ${{ $c->product->calculate($c->amount) }}
                        </div>
                    </div>

                    <div class="card-footer d-flex align-items-center">

                        @if($c->product->category)
                            <a class="me-2" href="{{ route('admin.categories.show', $c->product->category) }}">
                            <span class="badge bg-secondary">
                                {{ $c->product->category->name }}
                            </span>
                            </a>
                        @endif

                        <small class="text-secondary me-auto">
                            {{ $c->created_at->diffForHumans() }}
                        </small>

                        <a href="#" class="btn btn-sm btn-outline-primary border-0">
                            {{ __('View') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-4">
            <form action="{{ route('orders.store') }}" method="post" class="card card-body">
                @csrf

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="address" name="address" type="text">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 alert alert-secondary d-flex align-items-center justify-content-between border-0 py-2">
                    <small>
                        {{ __('Total') }}:
                    </small>
                    <div class="fs-4">
                        ${{ $total }}
                    </div>
                </div>

                <button class="btn btn-primary">
                    {{ __('Order') }}
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
