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
            <a class="dropdown-item"
               href="{{ route('contract.edit',$contract->id) }}">
                <i class="fa fa-edit" style="color:green"></i>
                Edit
            </a>
            <a data-toggle="modal" data-target="#declineModal" data-id="{{$contract->id}}" class="dropdown-item"
               href="#">
                <i class="fa fa-trash"></i>
                Terminate
            </a>
        @endif
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="declineModal" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-trash fa-fw"></i>Terminate Contract</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="declineModalForm">
                @csrf
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label class="text-left">Reason</label>
                        <input type="text" name="reason" id="reason" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="text-left">Effective Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="javascript:terminate();">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
@push('scripts')
<script>
  function terminate(){
      alert('ok');
  }

</script>

@endpush
