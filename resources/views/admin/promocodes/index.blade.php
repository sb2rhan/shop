<x-layouts.admin :title="__('Promocodes')">

    <x-slot name="toolbar">
        <a href="{{ route('admin.promocodes.create') }}" class="btn btn-success">
            {{ __('Add promocode') }}
        </a>
    </x-slot>

    @if($promocodes->isEmpty())
        <div class="alert alert-secondary">
            {{ __('There is no promocodes') }}
        </div>

    @else

        <div class="row row-cols-5 g-4">
            @foreach($promocodes as $promocode)
                <div class="col">
                    <div class="card card-body d-flex flex-row align-items-center justify-content-between">
                        <strong>
                            {{ $promocode->code }}
                        </strong>

                        <div>
                            {{ $promocode->discount }}%
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($promocodes->hasPages())
            <div class="my-3">
                {{ $promocodes->links() }}
            </div>
        @endif

    @endif

</x-layouts.admin>
