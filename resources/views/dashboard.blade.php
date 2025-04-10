<x-app-layout>

    <x-slot:headLinks>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot:headLinks>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tags"></canvas>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tasksProgress"></canvas>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tasksCompleted"></canvas>
            </div>
        </div>
    </div>


    <script>
        const tags = document.getElementById('tags');
        const tagItems = @json($tags);

        new Chart(tags, {
            type: 'line',
            data: {
                labels: tagItems.map(item => item.name),
                datasets: [{
                    label: 'Tags',
                    data: tagItems.map(item => item.tags_count),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Memastikan hanya angka bulat yang muncul
                            precision: 0 // Menghindari angka pecahan
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const taskItems = @json($tasks);
    </script>
    <script>
        const tasksProgress = document.getElementById('tasksProgress');

        new Chart(tasksProgress, {
            type: 'line',
            data: {
                labels: taskItems.map(item => item.title),
                datasets: [{
                    label: 'Progress Tasks',
                    data: taskItems.map(item => item.progress),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 0, // Nilai minimum 0
                        suggestedMax: 100, // Nilai maksimum 100
                        ticks: {
                            stepSize: 10, // Memastikan hanya angka bulat yang muncul
                            precision: 0 // Menghindari angka pecahan
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
