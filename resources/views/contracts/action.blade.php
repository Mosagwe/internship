<div class="dropdown">
    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item"
           href="{{ route('contract.show',$contract->id) }}">
            <i class="fa fa-eye fa-fw" style="color:steelblue"></i>
            View
        </a>
    @if($contract->status==\App\Models\Contract::ACTIVE)
        <!-- Button trigger modal -->
            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editContractModal">
                <i class="fa fa-edit" style=""></i> Edit
            </button>
            <a class="dropdown-item"
               href="{{ route('contract.terminate',$contract->id) }}">
                <i class="fa fa-lock red"></i>
                Deactivate
            </a>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editContractModal" tabindex="-1" role="dialog" aria-labelledby="editContractModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContractModalLabel">Edit Contract</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="" value="{{ $contract->employee->fullname }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



