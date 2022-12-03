<div class="table-responsive">
    <table class="table table-striped table-hover {{ $class ?? '' }}" id="{{ $id ?? '' }}">
        <thead>{{ $thead }}</thead>

        <tbody>{{ $slot }}</tbody>

        @isset($tfoot)
            <tfoot>{{ $tfoot }}</tfoot>
        @endisset
    </table>
</div>
