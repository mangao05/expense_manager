<form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
@csrf 
    <input type="hidden" name="_method" id="method">
    <div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table class="table" >
                        <input type="hidden" name="id" id="inputId" />
                        <tr >
                            <td class="border-none">
                                <label for="name">Display Name:</label>
                            </td>
                            <td class="border-none">
                                <input type="text" id="inputName" name="name" class="form-control rounded-0 border border-dark"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-none">
                                <label for="description">Description:</label>
                            </td>
                            <td class="border-none">
                                <input type="description" id="inputDescription" name="description" class="form-control rounded-0 border border-dark"/>
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