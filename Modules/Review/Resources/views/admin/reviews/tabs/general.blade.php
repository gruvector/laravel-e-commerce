<div class="row">
    <div class="col-md-8">
        {{ Form::select('rating', trans('review::attributes.rating'), $errors, array_combine(range(1, 5), range(1, 5)), $review, ['required' => true]) }}
        {{ Form::text('reviewer_name', trans('review::attributes.reviewer_name'), $errors, $review, ['required' => true]) }}
        {{ Form::textarea('comment', trans('review::attributes.comment'), $errors, $review, ['required' => true]) }}
        {{ Form::checkbox('is_approved', trans('review::attributes.is_approved'), trans('review::reviews.form.approve_this_review'), $errors, $review) }}
    </div>
</div>
