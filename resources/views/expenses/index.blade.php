@extends('layouts.master')

@section('style')
<style>
    .border-none {
        border-top: none !important;
    }
</style>
@endsection

@section('content')
    <div class="container">
    <h1>Expenses</h1>
        <table class="table table-bordered table-hover">
            <thead class="bg-secondary">
                <tr>
                    <th>Expense Category</th>
                    <th>Amount</th>
                    <th>Entry Date</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr onclick="updateExpense('{{ $expense->id }}', '{{ $expense->category_id }}', '{{ $expense->amount }}', '{{ $expense->entry_date }}')">
                        <td>{{ $expense->category->name }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->entry_date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Expenses</td>    
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="button-add float-right">
            <button type="button" onclick="createExpense()" class="btn btn-success">Add Expense</button>
        </div>
    </div>

    @include('expenses.modal.expensemodal');

@endsection
@section('script')
    <script>
        function createExpense(){
            $("#modalTitle").html("Add Expense");
            $("#btnSubmit").html("Save");
            $("#btnDelete").hide();
            $("#expenseForm").attr("action", "/expenses");
            $("#btnSubmit").html("Save")
            $("#expenseForm").attr("method", "POST");
            $("#method").val("POST");
            $("#expensemodal").modal('show');
        }

        function updateExpense(id, category, amount, date){
            $("#inputDate").val(date);
            $("#inputCategory").val(category);
            $("#inputId").val(id);
            $("#inputAmount").val(amount);
            $("#btnDelete").fadeIn();
            $("#btnSubmit").html("Update");
            $("#method").val("PUT");
            $("#expenseForm").attr("action", "/expenses/"+id);
            $("#modalTitle").html("Update Expense");
            $("#expensemodal").modal('show');
        }

        $("#btnDelete").click(function(){
            var id = $("#inputId").val();
            var token = $(this).data("token");

            $.ajax({
                url: "expenses/"+id,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function (data)
                {
                    if(data == 1){
                        location.reload();
                    }
                }
            });
        });    
    </script>
@endsection