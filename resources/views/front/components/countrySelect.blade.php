<div class="form-group @if ($errors->has($name)) has-error @endif">

    <field-label :for="$name" :label="$label" />

    <select name="{{ $name }}">
        @foreach($countries as $countryCode => $countryName)
            <option {{ $isSelected($countryCode) ? 'selected' : '' }} value="{{ $countryCode }}">{{ $countryName }}</option>
        @endforeach
    </select>

    <form-error :fieldName="$name" />

</div>
