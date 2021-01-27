@extends('template.template_auth')
@section('title', $title)
@section('page_name', $page_name)

@section('head')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="card-text">{{ $students->count() }}</h2>
                    <h6 class="card-title">Students</h6>
                </div>
            </div>
        </div>

    </div>
    <div class="row text-center">
        <div class="col">
            <h3>Grade</h3>
            <canvas id="grade-chart"></canvas>
        </div>
        <div class="col">
            <h3>Department</h3>
            <canvas id="department-chart"></canvas>
        </div>
    </div>
@endsection

@section('script')
    @parent

    <script src="{{ url('js/utils.js') }}"></script>
    <script>
        function selectRandomColor() {
            let colors = Object.keys(window.chartColors)
            let index = Math.random() * colors.length
            index = Math.floor(index)
            return window.chartColors[colors[index]]
        }
        let grade_pie = {
            'labels': [],
            'data': [],
            'colors': [],
        }
        grades.forEach((item) => {
            grade_pie['labels'].push(item['grade_name']);
            grade_pie['data'].push(students.filter(student => student['grade_id'] == item['id']).length);
            grade_pie['colors'].push(selectRandomColor());
        });
        var grade_ctx = document.getElementById('grade-chart').getContext('2d');
        var chart = new Chart(grade_ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: grade_pie['labels'],
                datasets: [{
                    label: 'Grade',
                    backgroundColor: grade_pie['colors'],
                    borderColor: window.chartColors['white'],
                    data: grade_pie['data']
                }]
            },

            // Configuration options go here
            options: {}
        });
        let department_pie = {
            'labels': [],
            'data': [],
            'colors': [],
        }
        departments.forEach((item) => {
            department_pie['labels'].push(item['department_name']);
            department_pie['data'].push(students.filter(student => student['department_id'] == item['id']).length);
            department_pie['colors'].push(selectRandomColor());
        });
        var department_ctx = document.getElementById('department-chart').getContext('2d');
        var chart = new Chart(department_ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: department_pie['labels'],
                datasets: [{
                    label: 'Department',
                    backgroundColor: department_pie['colors'],
                    borderColor: window.chartColors['white'],
                    data: department_pie['data']
                }]
            },

            // Configuration options go here
            options: {}
        });

    </script>
@endsection
