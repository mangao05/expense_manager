@extends('layouts.master')
@section('style')
<style>
    .border-none {
        border-top: none !important;
    }
</style>
@endsection
@section('content')
    <h3>My Expenses</h3>
    <div class="row ">
        <div class="col-6">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th class="border-none">Expenses Category</th>
                        <th class="border-none">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="border-none">{{ $category->name }}</td>
                            <td class="border-none">$ @convert($category->expenses->sum('amount'))</td>
                        </tr>
                    @empty 
                        <tr>
                            <td colspan="2">Create Expenses Category</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
        <div class="col-6">
            <canvas id="myChart"></canvas>
        </div>

    </div>
    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0-rc.1/Chart.js"></script>
<script>
    var arrayLabel = [];
    var arrayAmount = [];
    $.ajax({
        url: "/home",
        method: "GET",
        dataType : "JSON",
        success : function(data) {
            data.label.forEach(label => {
                arrayLabel.push(label);
            })
            data.amount.forEach(amount => {
                arrayAmount.push(amount);
            })  
        } 
    });

    
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: arrayLabel,
        datasets: [{
        backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6",
            "#f1c40f",
            "#e74c3c",
            "#34495e"
        ],
        data: arrayAmount
        }]
    }
    });
</script>
@endsection