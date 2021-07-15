<?php
$previous = url()->previous();

if (request()->fullUrlIs($previous))
    $previous = route('admin.promocodes.index');

$promocode = $promocode ?? null;

?>

<x-layouts.admin :title="__($promocode ? 'Edit promocode' : 'New promocode')">

    <x-slot name="toolbar">
        <a href="{{ $previous }}" class="btn btn-outline-danger">
            {{ __('Cancel') }}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-4">

            <form class="card card-body"
                  action="{{ $promocode ? route('admin.promocodes.update', $promocode) : route('admin.promocodes.store') }}"
                  method="post"
            >
                @csrf @if($promocode) @method('put') @endif

                <div class="mb-3">
                    <label for="code" class="form-label">{{ __('Code') }}</label>
                    <input class="form-control @error('code') is-invalid @enderror " value="{{ old('code', $promocode->code ?? null) }}" type="text" id="code" name="code" />
                    @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">{{ __('Discount') }}</label>

                    <div class="input-group @error('discount') is-invalid @enderror">
                        <input class="form-control text-end @error('discount') is-invalid @enderror " aria-describedby="discount-text" value="{{ old('discount', $promocode->discount ?? null) }}" type="number" step="1" min="1" max="100" id="discount" name="discount" />
                        <span class="input-group-text" id="discount-text">%</span>
                    </div>

                    @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">
                    {{ __($promocode ? 'Edit' : 'Add') }}
                </button>

            </form>

        </div>
    </div>

</x-layouts.admin>
