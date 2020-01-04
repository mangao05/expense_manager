<form action="{{ route('expenses.store') }}" method="POST" id="expenseForm">
@csrf 
    <input type="hidden" name="_method" id="method">
    <div class="modal fade" id="expensemodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                <label for="category">Expense Category:</label>
                            </td>
                            <td class="border-none">
                                 <select id="inputCategory" class="form-control border border-dark rounded-0 font-weight-bold" name="category_id">
                                    <option value="">Select Category </option> 
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}" class="text-uppercase">{{ $category->name }}</option>
                                    @empty
                                        <option>Please Create Category</option>
                                    @endforelse
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-none">
                                <label for="amount">Amount:</label>
                            </td>
                            <td class="border-none">
                                <input type="number" id="inputAmount" min="0" name="amount" class="form-control rounded-0 border border-dark"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-none">
                                <label for="entry_date">Entry Date:</label>
                            </td>
                            <td class="border-none">
                                <input type="date" id="inputDate" name="entry_date" class="form-control rounded-0 border border-dark"/>
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