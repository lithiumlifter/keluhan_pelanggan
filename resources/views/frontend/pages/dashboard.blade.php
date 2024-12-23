@extends('frontend.templates.app')

@section('content')
<div class="container-fluid">
    <h4 class="page-title">Dashboard</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users Statistics</h4>
                    <p class="card-category">
                    Users statistics this month</p>
                </div>
                <div class="card-body">
                    <div id="monthlyChart" class="chart chart-pie"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">2018 Sales</h4>
                    <p class="card-category">
                    Number of products sold</p>
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
                <div class="card-title">Table Head States</div>
            </div>
            <div class="card-body">
                <table class="table table-head-bg-primary mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection