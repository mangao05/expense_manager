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
    <h3>Expenses Categories</h3>
        <table class="table table-bordered table-hover">
            <thead class="bg-secondary">
                <tr>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr onclick = "updateCategory('{{ $category->id }}', '{{ $category->name }}', '{{ $category->description }}')">
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($category->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @empty 
                    <tr>
                        <td colspan="3" class="text-center">No Category...</td>    
                    </tr>
                @endforelse
            </tbody>
        </table>

         <div class="button-add float-right">
            <button type="button" onclick="createCategory()" class="btn btn-success">Add Category</button>
        </div>
    </div>

    @include('expense_categories.modal.categorymodal');

@endsection

@section('script')
    <script>
        function updateCategory(id, name, description){
            $("#inputName").val(name);
            $("#inputId").val(id);
            $("#inputDescription").val(description);
            $("#btnDelete").fadeIn();
            $("#modalTitle").html("Update Category");
            $("#categoryForm").attr("action", "/categories/"+id);
            $("#btnSubmit").html("Update")
            $("#method").val("PUT");
            $("#categorymodal").modal('show');
        }

        function createCategory(){
            $("#inputName").val("");
            $("#inputId").val("");
            $("#inputDescription").val("");
            $("#btnDelete").css("display", "none");
            $("#modalTitle").html("Add Category");
            $("#roleForm").attr("action", "/categories");
            $("#btnSubmit").html("Save")
            $("#categoryForm").attr("method", "POST");
            $("#method").val("POST");
            $("#categorymodal").modal('show');
        }

        $("#btnDelete").click(function(){
            var id = $("#inputId").val();
            var token = $(this).data("token");

            $.ajax({
                url: "categories/"+id,
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

