@if($payroll->status==1)
    <span class="badge badge-success">Approved</span>
@elseif($payroll->status==0)
    <span class="badge badge-warning">Pending approval</span>
@endif
