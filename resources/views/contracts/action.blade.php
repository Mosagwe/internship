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
            <a class="dropdown-item"
               href="{{ route('contract.terminate',$contract->id) }}">
                <i class="fa fa-lock red"></i>
                Deactivate
            </a>
        @endif
    </div>
</div>




