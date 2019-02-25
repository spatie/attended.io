<div class="form-group @if ($errors->has($name)) has-error @endif">

    <field-label :for="$name" :label="$label" />

    <select name="{{ $name }}">
        @foreach($options as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>

    <form-error :fieldName="$name" />

</div>
