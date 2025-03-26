@extends('user.layout.main')
@section('style')
@endsection
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">BMI Tracker</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Welcome to BMI Tracker Dashboard</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu">
                                        <em class="icon ni ni-more-v"></em>
                                    </a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#"
                                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                                        <span><span class="d-none d-md-inline">Last 3 days</span>
                                                        </span><em class="dd-indc icon ni ni-chevron-right"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Last 3 days</span></a></li>
                                                        </ul>
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Last 7 days</span></a></li>
                                                        </ul>
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Last 1 month</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalBMIForm"><em
                                                        class="icon ni ni-plus"></em><span>BMI</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered h-100">
                        <div class="card-inner">
                            <div class="card-title-group pb-3 g-2">
                                <div class="card-title card-title-sm">
                                    <h6 class="title">BMI Analysis</h6>
                                    <p>Your BMI trends over time.</p>
                                </div>
                                <!-- Optional: additional controls can be added here -->
                            </div>
                            <div class="analytic-ov">
                                <!-- Summary Statistics -->
                                <div class="analytic-data-group analytic-ov-group g-3">
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Avg BMI</div>
                                        <div class="amount" id="avgBMI">-</div>
                                    </div>
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Min BMI</div>
                                        <div class="amount" id="minBMI">-</div>
                                    </div>
                                    <div class="analytic-data analytic-ov-data">
                                        <div class="title">Max BMI</div>
                                        <div class="amount" id="maxBMI">-</div>
                                    </div>
                                </div>
                                <!-- Chart Container -->
                                <div style="max-height: 400px">
                                    <canvas class="analytics-line-large" id="analyticBMIData"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>BMI</th>
                                        <th>Height (cm)</th>
                                        <th>Weight (kg)</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($BMIRecords as $BMIRecord)
                                        <tr>
                                            <td>{{ $BMIRecord->id }}</td>
                                            <td class="lead-text">{{ $BMIRecord->BMI }}</td>
                                            <td>{{ $BMIRecord->height }}</td>
                                            <td>{{ $BMIRecord->weight }}</td>
                                            <td>{{ $BMIRecord->created_at }}</td>
                                            @if ($BMIRecord->category === 'UNDERWEIGHT')
                                                <td style="color:#6576FF">Underweight</td>
                                            @elseif($BMIRecord->category === 'NORMAL_WEIGHT')
                                                <td style="color: #1EE0AC">Normal weight</td>
                                            @elseif($BMIRecord->category === 'OVERWEIGHT')
                                                <td style="color: #F4BD0E">Overweight</td>
                                            @elseif($BMIRecord->category === 'OBESE')
                                                <td style="color: #E85347">Obese</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function calculateBMI() {
            event.preventDefault();
            var height = parseFloat($('#height').val().trim() / 100);
            var weight = parseFloat($('#weight').val().trim());


            var bmi = (weight / (height * height)).toFixed(2);

            console.log(bmi);
            const messageElement = $("#modalBMIMessage");
            var message = `Your BMI is <b>${bmi}</b> and you are `;
            var color = "";

            // Categorize BMI and set color accordingly
            if (bmi < 18.5) {
                message += "Underweight";
                color = "blue";
            } else if (bmi >= 18.5 && bmi < 25) {
                message += "Normal weight";
                color = "green";
            } else if (bmi >= 25 && bmi < 30) {
                message += "Overweight";
                color = "orange";
            } else if (bmi >= 30) {
                message += "Obese";
                color = "red";
            }
            console.log(messageElement[0].innerHTML);
            console.log(messageElement[0].style.color);
            // Set the message and color in the modal
            messageElement[0].innerHTML = message + `. Do you want to save this record?`;
            messageElement[0].style.color = color;

            // Show the modal
            $('#modalBMIDisplay').modal('show');
            $('#BMIValue').val(bmi);
        }

        function storeBMI() {
            event.preventDefault();
            var token = $('#token').val().trim();
            var bmi = $('#BMIValue').val().trim();
            var height = $('#height').val().trim();
            var weight = $('#weight').val().trim();
            console.log(token);
            console.log(bmi);
            var formData = new FormData();
            formData.append('token', token);
            formData.append('BMI', bmi);
            formData.append('height', height);
            formData.append('weight', weight);

            $('#storeBMIBtn').prop('disabled', true);

            $.ajax({
                url: '{{ route('user.BMI.create') }}',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.status === true) {
                        $('#modalSuccessMessage').text(response.message);
                        $('#modalSuccess').modal('show');
                        $('#modalSuccess').on('hidden.bs.modal', function(e) {
                            location.reload()
                        });
                    } else {
                        console.log(response);
                        $('#modalFail').modal('show');
                        $('#modalFailMessage').text(response.message);
                        $('#modalFail').on('hidden.bs.modal', function(e) {
                            location.reload();
                        });
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        $('#modalFail').modal('show');
                        $('#modalFailMessage').text(response.message);
                    } else {
                        console.log(response);
                        $('#modalFailMessage').text(response.message);
                        $('#modalFail').modal('show');
                    }
                },
                complete: function(response) {
                    $('#storeBMIBtn').prop('disabled', false);
                }
            })
        }

        // Parse the JSON BMI data passed from the controller
        let bmiRecords = {!! $bmiDataJson !!};

        // Extract dates and BMI values for the chart.
        // Ensure your `created_at` values include the time (e.g., "2025-03-25 20:46:19").
        let dates = bmiRecords.map(record => record.created_at);
        let bmiValues = bmiRecords.map(record => parseFloat(record.bmi));

        // Calculate summary statistics (average, min, max)
        let sum = bmiValues.reduce((acc, val) => acc + val, 0);
        let avgBMI = (bmiValues.length ? (sum / bmiValues.length).toFixed(2) : 0);
        let minBMI = (bmiValues.length ? Math.min(...bmiValues) : 0);
        let maxBMI = (bmiValues.length ? Math.max(...bmiValues) : 0);

        // Update summary statistics in the DOM
        document.getElementById('avgBMI').innerText = avgBMI;
        document.getElementById('minBMI').innerText = minBMI;
        document.getElementById('maxBMI').innerText = maxBMI;

        /// Get the context of the canvas element
        const ctx = document.getElementById('analyticBMIData').getContext('2d');

        // Create a new Chart instance
        const bmiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates, // X-axis: your dates (timestamps)
                datasets: [{
                    label: 'BMI Over Time',
                    data: bmiValues, // Y-axis: BMI values
                    fill: false,
                    borderColor: '#9FC131',
                    backgroundColor: '#9FC131',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'time', // Use time scale for x-axis
                        time: {
                            parser: 'YYYY-MM-DD HH:mm:ss', // Adjust according to your timestamp format
                            unit: 'hour', // Unit (if data falls on one day, for instance)
                            displayFormats: {
                                hour: 'HH:mm'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 40, // Adjust as needed for typical BMI values
                        title: {
                            display: true,
                            text: 'BMI'
                        },
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function(tooltipItem) {
                                return 'BMI: ' + tooltipItem.formattedValue;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
