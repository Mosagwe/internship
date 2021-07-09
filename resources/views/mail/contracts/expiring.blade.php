@component('mail::message')
# Dear {{ $contract->employee->firstname }}

This is to inform you that your contract is coming to an end
on {{ $contract->end_date }}.

For any concerns, please contact the HR office.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
