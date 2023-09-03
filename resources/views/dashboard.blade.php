<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">            
                <div class="bg-white py-10 sm:py-12">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Cantidad Estudiantes</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $data['students'] }}</dd>
                        </div>
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Cantidad Certificados Programas</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $data['certificate'] }}</dd>
                        </div>
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">New users annually</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">46,000</dd>
                        </div>
                        </dl>
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
                            
                            <div>
                          
                                {{ __("Consultas cantidad de certificados de programas por años/mes ") }}
            
                                <select name="" id="year-id" class="gag-5">
                                    @foreach ($data['year'] as $year)
                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                    @endforeach
                                </select>
                        
                            </div>
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

