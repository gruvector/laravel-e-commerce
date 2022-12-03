<div class="form-group">
    <label for="to">{{ trans('report::admin.filters.date_end') }}</label>
    <input type="text" name="to" class="form-control datetime-picker" id="to" data-default-date="{{ $request->to }}">
</div>
