<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row">
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
    <div class="flex flex-row">
        <div class="md:flex mx-auto sm:px-6 lg:px-8 gap-6">
            <div class="mx-auto">
                <div class="mx-auto bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-5 text-gray-900">
                            {{ __("You're logged in!") }}
                            <select name="" id="year-id">
                                <option value="1986">1986</option>
                                <option value="1970">1970</option>
                                <option value="2000">2000</option>
                                <option value="2019">2019</option>
                            </select>
                            <div style="width: 600px; margin: auto;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="mx-auto">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-5 text-gray-900">
                            <div style="width: 340px; margin: auto;">
                                <canvas id="myChartPie"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<script src="{{ asset('/js/app.js') }}"></script>

