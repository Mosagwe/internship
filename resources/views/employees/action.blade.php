<div class="dropdown">
    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item"
           href="{{ route('employee.show',$employee->id) }}">
            <i class="fa fa-eye fa-fw" style="color:steelblue"></i>
            View
        </a>
        <a class="dropdown-item"
           href="{{ route('employee.edit',$employee->id) }}">
            <i class="fa fa-edit" style="color:green"></i>
            Edit
        </a>
        @if($employee->is_active==\App\Models\Employee::ACTIVE)
            <a class="dropdown-item"
               href="{{ route('employee.changestatus',$employee->id) }}">
                <i class="fa fa-lock"></i>
                Disable
            </a>
        @elseif($employee->is_active==\App\Models\Employee::DEACTIVATED)
            <a class="dropdown-item"
               href="{{ route('employee.changestatus',$employee->id) }}">
                <i class="fa fa-unlock"></i>
                Enable
            </a>
        @endif

        <a data-action="delete" data-form="#delete-form" class="dropdown-item" href="#" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
            <i class="fa fa-trash" style="color:red"></i>
            Delete
        </a>
        <form action="{{ route('employee.destroy',$employee->id) }}" method="POST" id="delete-form">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

