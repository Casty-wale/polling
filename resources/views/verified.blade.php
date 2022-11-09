<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- {{ $place = request()->is("verified?verified=2") }} --}}
                    <div style="visibility: hidden;">
                        {{ $place = str_replace(Request::url().'?', '', Request::fullUrl()) }}
                    </div>

                    @if($place === "verified=1")
                        Your account has been verified.
                    @elseif($place === "verified=2")
                        Your account has already been verified.
                    @else
                        Something went wrong.
                    @endif

                    {{-- {{ Request::fullUrl() }} --}}
                    {{-- {{ $request->url() }} --}}
                    {{-- {{ Request::url() }}; --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
