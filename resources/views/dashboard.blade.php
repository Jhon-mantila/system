<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-5 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                    <div class="p-5 text-gray-900">
                        {{ __("You're logged in!") }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 sm:px-6 lg:px-8 gap-4">
        <div class="">
            <div class="mx-auto">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900">
                        {{ __("You're logged in!") }}
                        <div style="width: 550px; margin: auto;">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto ">
                <div class="bg-white  shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900">
                        {{ __("You're logged in!") }}
                        <div style="width: 550px; margin: auto;">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('/js/app.js') }}"></script>

