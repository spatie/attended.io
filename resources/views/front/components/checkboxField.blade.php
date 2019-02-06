<label class="form-group">

    <input type="checkbox" name="{{ $name }}" value="1" {{ $isChecked ? 'checked="checked"' : '' }}> {{ __($label ?? '') }}

    <form-error :field-name="$name" />

</label>
