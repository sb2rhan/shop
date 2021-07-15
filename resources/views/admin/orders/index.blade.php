<x-layouts.admin :title="__('Orders')">

    @if($orders->isEmpty())
        <div class="alert alert-secondary">
            {{ __('There is no orders') }}
        </div>
    @else
        @foreach($orders as $order)

            <div class="card my-2">

                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="p-3 list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col">
                                {{ $order->user->name }}
                            </div>
                            <div class="col">
                                {{ $order->user->email }}
                            </div>
                            <div class="col">
                                {{ $order->address }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        @endforeach

        @if($orders->hasPages())
            <div class="my-3">
                {{ $orders->links() }}
            </div>
        @endif
    @endif

</x-layouts.admin>
