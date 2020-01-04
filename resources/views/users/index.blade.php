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
<h3>Users</h3>
    <table class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Role</th>
                <th>Created at </th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                @php 
                    $name = $user->name;
                    $email = $user->email;
                    $id = $user->id;
                    $role = $user->role->id;
                @endphp
                <tr onclick="updateUser('{{ $id }}', '{{ $name }}', '{{ $email }}', '{{ $role }}')">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                </tr>
            @empty 
                <tr>
                    <td colspan="4" class="text-center">No User Data...</td>    
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="button-add float-left">
        {{ $users->links() }}
    </div>
    <div class="button-add float-right">
        <button type="button" onclick="openModal()" class="btn btn-success">Add User</button>
    </div>
</div>

@include('users.modal.usermodal')

@endsection
@section('script')
<script>
    function openModal(){
        $("#modalTitle").html("Add User");
        $("#inputName").val("");
        $("#inputId").val("");
        $("#inputEmail").val("");
        $("#inputRole").val("");
        $("#userForm").attr("action", "/users");
        $("#userForm").attr("method", "POST");
        $("#btnSubmit").html("Save");
        $("#method").val("POST");
        $("#btnDelete").css("display", "none");
        $("#usermodal").modal('show');
    }
    function updateUser(id, name, email, role){
        $("#modalTitle").html("Update User");
        $("#btnDelete").css("display", "block");
        $("#inputName").val(name);
        $("#inputId").val(id);
        $("#inputEmail").val(email);
        $("#inputRole").val(role);
        $("#btnSubmit").html("Update")
        $("#userForm").attr("action", "/users/"+id);
        $("#method").val("PUT");
        $("#usermodal").modal('show');
    }

    $("#btnDelete").click(function(){
        var id = $("#inputId").val();
        var token = $(this).data("token");

         $.ajax({
            url: "users/"+id,
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