@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-screen-md">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 shadow-md mt-20">
                <div class="bg-gray-300 text-gray-700 uppercase text-center py-3 px-6 mb-0">{{ __('Reset Password') }}</div>

                    <form class="py-10 px-6" method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf

                        @if (session('status'))
                        <div class="bg-green-100 border-l-4 border-green-400 text-green-700 p-4 w-full my-5 block" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm mb-2">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="p-2 bg-gray-100 rounded form-input w-full @error('email') border border-red-500 @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="bg-red-100 border-l-4 border-red-400 text-red-700 p-4 w-full mt-5" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <button type="submit" class="bg-teal-500 w-full hover:bg-teal-800 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase font-bold mt-3">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
