<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#renewModal{{ $contract->id }}">
        Renew
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="renewModal{{ $contract->id  }}" tabindex="-1" role="dialog" aria-labelledby="renewModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renewModalLabel">Contract Renewal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="renewalForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group text-left">
                                <h3 class="text-secondary">
                                    Name: {{ $contract->firstname }}  {{$contract->lastname}}</h3>
                                <input type="text" name="employee_id" id="employee_id"
                                       value="{{ $contract->employee->id }}">
                            </div>
                            <div class="form-group text-left">
                                <label for="">Station</label>
                                <select class="form-control form-control-sm @error('station_id') is-invalid @enderror" name="station_id" id="station_id">
                                    <option value=""> --select station--</option>
                                    @if($stations)
                                        @foreach($stations as $station)
                                            <option value="{{ $station->id }}"> {{ $station->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                               <span class="text-danger error-text station_id_error"></span>
                            </div>
                            <div class="form-group text-left">
                                <label for="">Start Date</label>
                                <input type="date" id="start_date" name="start_date"
                                       class="form-control form-control-sm">
                                <span class="text-danger error-text start_date_error"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary renew">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


