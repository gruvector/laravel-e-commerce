<button type="button" class="btn btn-default select-media"
    data-id="{{ $file->id }}"
    data-path="{{ $file->path }}"
    data-filename="{{ $file->filename }}"
    data-type="{{ strtok($file->mime, '/') }}"
    data-icon="{{ $file->icon() }}"
    data-toggle="tooltip"
    title="{{ trans('media::media.file_manager.select_this_file') }}"
>
    <i class="fa fa-check-square-o"></i>
</button>
