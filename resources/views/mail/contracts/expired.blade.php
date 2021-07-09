@component('mail::message')
# Dear {{ $contract->employee->firstname }}

This is to inform you that your contract has expired
on {{ $contract->end_date }}.

For any concerns, please contact the HR office.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
