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
    <h3>Roles</h3>
        <table class="table table-bordered table-hover">
            <thead class="bg-secondary">
                <tr>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr onclick="updateRole('{{ $role->id }}', '{{ $role->name }}', '{{ $role->description }}')">
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($role->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @empty 
                    <tr>
                        <td colspan="3" class="text-center">No Roles...</td>    
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="button-add float-right">
            <button type="button" onclick="openModal()" class="btn btn-success">Add Role</button>
        </div>
    </div>

@include('roles.modal.rolemodal')

@endsection

@section('script')
    <script>
        function openModal(){
            $("#modalTitle").html("Add Role");
            $("#btnDelete").css("display", "none");
            $("#inputId").val("");
            $("#inputName").val("");
            $("#inputDescription").val("");
            $("#roleForm").attr("action", "/roles");
            $("#btnSubmit").html("Save")
            $("#roleForm").attr("method", "POST");
            $("#method").val("POST");
            $("#rolemodal").modal('show');
        }

        function updateRole(id, name, description){
            $("#modalTitle").html("Update Role");
            $("#btnDelete").fadeIn();
            $("#inputId").val(id);
            $("#inputName").val(name);
            $("#inputDescription").val(description);
            $("#btnSubmit").html("Update")
            $("#method").val("PUT");
            $("#roleForm").attr("action", "/roles/"+id);
            $("#rolemodal").modal('show');
        }
        $("#btnDelete").click(function(){
            var id = $("#inputId").val();
            var token = $(this).data("token");

            $.ajax({
                url: "roles/"+id,
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
                    }else{
                        alert("Cannot be deleted: ADMIN ROLE");
                    }
                }
            });
        });    
    </script>
@endsection