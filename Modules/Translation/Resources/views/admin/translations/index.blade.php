@extends('admin::layout')

@section('title', trans('translation::translations.translations'))

@component('admin::components.page.header')
    @slot('title', trans('translation::translations.translations'))

    <li class="active">{{ trans('translation::translations.translations') }}</li>
@endcomponent

@section('content')
    <div class="box box-primary">
        <div class="box-body index-table">
            <table class="table table-hover translations-table">
                <thead>
                    <tr>
                        <th>{{ trans('translation::translations.table.key') }}</th>

                        @foreach (supported_locales() as $locale => $language)
                            <th>{{ $language['name'] }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach ($translations as $key => $translation)
                        <tr>
                            <td>{{ $key }}</td>

                            @foreach (supported_locales() as $locale => $language)
                                <td class="translation-td">
                                    <a href="#" class="translation editable-click {{ array_has($translation, $locale) ? '' : 'editable-empty' }}"
                                        data-locale="{{ $locale }}"
                                        data-key="{{ $key }}"
                                    >{{ array_get($translation, $locale) }}</a>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
