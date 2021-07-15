<x-layouts.app :title="__('Cart')">

    @if($cart->isEmpty())

        <div class="alert alert-warning">
            {{ __('There is no items in your cart') }}
        </div>

    @else

        <div class="card card-body">
            <table class="table table-bordered">

                <thead>
                <tr>
                    <th width="100%">{{ __('Name') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Total') }}</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($cart as $c)
                    <tr>
                        <td>
                            {{ $c->product->name }}
                        </td>
                        <td class="text-end">
                            {{ $c->amount }}
                        </td>
                        <td class="text-end">
                            ${{ $c->product->calculate() }}
                        </td>
                        <td class="text-end">
                            ${{ $c->product->calculate($c->amount) }}
                        </td>
                        <td>
                            <form action="{{ route('cart.destroy', $c) }}" method="post">
                                @csrf @method('delete')
                                <button class="btn btn-sm btn-outline-danger border-0">
                                    &times;
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if(session()->has('discount'))
                    <tr>
                        <td>{{ __('Discount') }}</td>
                        <td class="text-end">{{ session()->get('discount') * 100 }}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif

                <tr>
                    <td colspan="3"></td>
                    <td class="text-end">${{ $total * (1 - session()->get('discount')) }}</td>
                    <td></td>
                </tr>
                </tbody>

            </table>

            @if(!session()->has('discount'))
                <hr>
                <form action="{{ route('cart.promocode') }}" method="post">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="code" class="form-label">{{ __('Promocode') }}</label>
                            <input class="form-control @error('code') is-invalid @enderror " type="text" name="code" id="code" value="{{ old('code') }}">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">
                        {{ __('Apply promocode') }}
                    </button>

                </form>
                <hr>
            @endif

            <a href="{{ route('orders.create') }}" class="ms-auto btn btn-success">
                {{ __('Proceed order') }}
            </a>
        </div>
    @endif

</x-layouts.app>
