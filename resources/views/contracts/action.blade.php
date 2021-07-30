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
<div class="modal fade justify-content-between" id="editContractModal" tabindex="-1" role="dialog" aria-labelledby="editContractModalLabel"
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
                        <div class="row">
                            <div class="col-md-10">
                                <div class="modal-body jsgrid-align-left">
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        {{ strtoupper($contract->employee->fullname) }}
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="text"
                                                   class="form-control datepicker @error('date_hired') is-invalid @enderror"
                                                   id="date_hired" name="date_hired"
                                                   value="{{ $contract->start_date }}"
                                                   autocomplete="off">
                                            @error('date_hired')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Station</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>






