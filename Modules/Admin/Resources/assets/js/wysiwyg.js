import tinyMCE from 'tinymce';

tinyMCE.baseURL = `${FleetCart.baseUrl}/modules/admin/js/wysiwyg`;

tinyMCE.init({
    selector: '.wysiwyg',
    theme: 'silver',
    mobile: { theme: 'mobile' },
    height: 350,
    menubar: false,
    branding: false,
    image_advtab: true,
    automatic_uploads: true,
    media_alt_source: false,
    media_poster: false,
    relative_urls: false,
    directionality: FleetCart.rtl ? 'rtl' : 'ltr',
    cache_suffix: `?v=${FleetCart.version}`,
    plugins: 'lists, link, table, image, media, paste, autosave, autolink, wordcount, code, fullscreen',
    toolbar: 'styleselect bold italic underline | bullist numlist | alignleft aligncenter alignright | outdent indent | image media link table | code fullscreen',

    images_upload_handler(blobInfo, success, failure) {
        let formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        $.ajax({
            method: 'POST',
            url: route('admin.media.store'),
            data: formData,
            processData: false,
            contentType: false,
        }).then((file) => {
            success(file.path);
        }).catch((xhr) => {
            failure(xhr.responseJSON.message);
        });
    },
});
