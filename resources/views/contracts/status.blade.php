@if($contract->status==\App\Models\Contract::ACTIVE)
    <span class="badge badge-success">Active</span>
@elseif($contract->status==\App\Models\Contract::INACTIVE)
    <span class="badge badge-danger">Inactive</span>
@else
    <span class="badge badge-danger">Unknown</span>
@endif
