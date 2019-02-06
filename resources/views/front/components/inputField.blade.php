<div class="form-group @if ($errors->has($name)) has-error @endif">

    <field-label :for="$name" :label="$label" />

    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        value="{{ formValue($name, $model ?? null, $modelProperty ?? null) }}"
    />

    <form-error :fieldName="$name" />

</div>
