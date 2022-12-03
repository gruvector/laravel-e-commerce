<div class="form-group">
    <label for="group">{{ trans('report::admin.filters.group_by') }}</label>

    <select name="group" id="group" class="custom-select-black">
        <option value="">{{ trans('report::admin.filters.please_select') }}</option>

        @foreach (trans('report::admin.filters.groups') as $group => $label)
            <option value="{{ $group }}" {{ $request->group === $group ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
