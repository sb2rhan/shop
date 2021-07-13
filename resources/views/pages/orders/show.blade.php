<x-layouts.app :title="__('Order')">
    <h1 class="h3 mb-3">{{ __('Order') }}</h1>

    <div class="row">

        <div class="col">
            @foreach($orderProducts as $orderProduct)
                <div class="card my-3">

                    <div class="card-body d-flex align-items-start">
                        <div>
                            @if($orderProduct['product'])
                                <div class="fw-bold card-title">
                                    {{ $orderProduct['product']->name }}
                                </div>

                                @if($orderProduct['product']->description)
                                    {{ $orderProduct['product']->description }}
                                @endif
                            @else
                                DELETED
                            @endif
                        </div>

                        <div class="text-secondary fs-4 ms-auto d-flex align-items-center">
                            <span class="fs-6 me-2">
                                ${{ $orderProduct['price'] / 100 }} &times; {{ $orderProduct['amount'] }}
                            </span>

                            ${{ $orderProduct['total'] / 100 }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-3">
            <div class="card card-body">
                <small class="text-secondary">{{ __('Address') }}</small>
                <div>{{ $order->address }}</div>
            </div>
        </div>
    </div>
</x-layouts.app>
