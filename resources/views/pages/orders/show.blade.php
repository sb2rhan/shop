<x-layouts.app :title="__('Order')">
    <h1 class="h3 mb-3">
        {{ __('Order') }}
    </h1>

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
                @if($order->is_approved)
                    <div class="alert alert-success mb-3">
                        {{ __('This order is approved!') }}
                    </div>
                @else
                    <div class="alert alert-warning mb-3">
                        {{ __('Waiting for approval...') }}
                    </div>
                @endif
                <small class="text-secondary">{{ __('Address') }}</small>
                <div>{{ $order->address }}</div>

                @if(!$order->is_approved && (auth()->user()->hasRole('admin', 'manager')))

                    <div class="mt-3">
                        <form action="{{ route('admin.orders.approve', $order) }}" method="post">
                            @csrf @method('put')
                            <button class="btn btn-primary">
                                {{ __('Approve') }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
