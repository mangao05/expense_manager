<form action="{{ route('users.store') }}" method="POST" id="userForm">
@csrf 
    <input type="hidden" name="_method" id="method">
    <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">Default password: <b>purplebug</b></div>
                    <table class="table" >
                        <input type="hidden" name="id" id="inputId" />
                        <tr >
                            <td class="border-none">
                                <label for="name">Name:</label>
                            </td>
                            <td class="border-none">
                                <input type="text" id="inputName" name="name" class="form-control rounded-0 border border-dark"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-none">
                                <label for="email">Email Address:</label>
                            </td>
                            <td class="border-none">
                                <input type="email" id="inputEmail" name="email" class="form-control rounded-0 border border-dark"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-none">
                                <label for="role">Role:</label>
                            </td>
                            <td class="border-none">
                                <select id="inputRole" class="form-control border border-dark rounded-0 font-weight-bold" name="role_id">
                                <option value="">Select Role </option> 
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}" class="text-uppercase">{{ $role->name }}</option>
                                @empty
                                    <option>Please Create Role</option>
                                @endforelse
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-auto" id="btnDelete" style="display:none;" data-token="{{ csrf_token() }}">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>