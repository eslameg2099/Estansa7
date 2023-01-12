@include('dashboard.errors')
{{ BsForm::text('code') }}

{{ BsForm::number('percentage_value')->min(1)->step('any') }}



{{ BsForm::number('usage_count')->min(1) }}






{{ BsForm::date('expired_at') }}



