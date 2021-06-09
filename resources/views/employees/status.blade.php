@if($employee->is_active==\App\Models\Employee::ACTIVE)
    <span class="badge badge-success">Active</span>
@elseif($employee->is_active==\App\Models\Employee::DEACTIVATED)
    <span class="badge badge-danger">Inactive</span>
@else
    <span class="badge badge-danger">Unknown</span>
@endif
