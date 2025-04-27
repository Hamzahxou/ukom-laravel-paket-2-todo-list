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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 items-start gap-5">
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tags"></canvas>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tasksProgress"></canvas>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg p-2">
                <canvas id="tasksPriority" width="188" height="188"></canvas>
            </div>
        </div>
    </div>


    <script>
        function GFG(str, maxLength) {
            if (str.length > maxLength) {
                return str.substring(0, maxLength) + '...';
            }
            return str;
        }
    </script>

    <script>
        const tags = document.getElementById('tags');
        const tagItems = @json($tags);
        const tagItemCount = tagItems.map(item => item.tags_count)

        new Chart(tags, {
            type: 'line',
            data: {
                labels: tagItems.map(item => GFG(item.name, 10)),
                datasets: [{
                    label: 'Tags',
                    data: tagItemCount,
                    borderWidth: 1
                }]
            },
            options: {
                elements: {
                    line: {
                        tension: 0.4, // garis melengkung
                        borderColor: '#3d3d3d', // warna garis default
                    },
                    point: {
                        radius: 0,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        beginAtZero: true,
                        max: Math.max(...tagItemCount) + 2,
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
        const tasksProgress = document.getElementById('tasksProgress');

        new Chart(tasksProgress, {
            type: 'line',
            data: {
                labels: taskItems.map(item => GFG(item.title, 10)),
                datasets: [{
                    label: 'Progress Tasks',
                    data: taskItems.map(item => item.progress),
                    borderWidth: 1
                }]
            },
            options: {
                elements: {
                    line: {
                        tension: 0.4, // garis melengkung
                        borderColor: '#3d3d3d', // warna garis default
                    },
                    point: {
                        radius: 0,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 10, // Memastikan hanya angka bulat yang muncul
                            precision: 0 // Menghindari angka pecahan
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const tasksPriority = document.getElementById('tasksPriority');
        const priorities = @json($priorities);
        const priority = Object.entries(priorities);
        new Chart(tasksPriority, {
            type: 'doughnut',
            data: {
                labels: priority.map(item => item[0]),
                datasets: [{
                    label: 'Priority Tasks',
                    data: priority.map(item => item[1]),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]

            },
            options: {
                responsive: true, // Membuat chart responsif
                maintainAspectRatio: false, // Membolehkan chart mengubah rasio aspek
            }
        });
    </script>
</x-app-layout>
