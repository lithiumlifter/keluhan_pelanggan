@extends('frontend.templates.app')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Dashboard</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Statistik Keluhan Pie Chart</h4>
                    <p class="card-category">
                    Berdasarkan Status Keluhan</p>
                </div>
                <div class="card-body">
                    <div id="monthlyChart" class="chart chart-pie"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Statistik Keluhan Bar Chart</h4>
                    <p class="card-category">
                        Berdasarkan Status Keluhan Perbulan</p>
                </div>
                <div class="card-body">
                    <div id="salesChart" class="chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Top 10 Keluhan</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-head-bg-primary mt-4">
                        <thead>
                            <tr>
                                <th scope="col">nama</th>
                                <th scope="col">email</th>
                                <th scope="col">created_at</th>
                                <th scope="col">umur_keluhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keluhan as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>{{ $item->umur_keluhan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var dataSales = {
            labels: {!! json_encode($months) !!},
            series: [
                {!! json_encode($receivedCounts) !!},
                {!! json_encode($inProcessCounts) !!},
                {!! json_encode($doneCounts) !!}
            ]
        };

        var optionChartSales = {
            plugins: [
                Chartist.plugins.tooltip()
            ],
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px",
        };

        var responsiveChartSales = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0]
                    }
                }
            }]
        ];

        Chartist.Bar('#salesChart', dataSales, optionChartSales, responsiveChartSales);
    </script>
    <script>
        var receivedPercentage = {{ $receivedPercentage }};
        var inProcessPercentage = {{ $inProcessPercentage }};
        var donePercentage = {{ $donePercentage }};
    
        new Chartist.Pie('#monthlyChart', {
            labels: ['Received', 'In Process', 'Done'],
            series: [receivedPercentage, inProcessPercentage, donePercentage]
        }, {
            chartPadding: 20,
            labelOffset: 0,
            labelDirection: 'explode',
            series: {
                '0': { 
                    color: '#ff4e4e'
                },
                '1': { 
                    color: '#f4b400'
                },
                '2': { 
                    color: '#34a853'
                }
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });
    </script>
@endpush
@endsection