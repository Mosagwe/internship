@component('mail::message')
# Dear {{ $user->name }}

The payroll for the month of {{ date('F Y',strtotime($payroll->period)) }} has been processed .
Please login in to approve.

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
