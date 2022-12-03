<?php

namespace Modules\Category\Http\Controllers\Admin;

use Modules\Category\Entities\Category;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Category\Http\Requests\SaveCategoryRequest;

class CategoryController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'category::categories.category';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'category::admin.categories';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCategoryRequest::class;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::with('files')->withoutGlobalScope('active')->find($id);
    }

    /**
     * Destroy resources by given ids.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::withoutGlobalScope('active')
            ->findOrFail($id)
            ->delete();

        return back()->withSuccess(trans('admin::messages.resource_deleted', ['resource' => $this->getLabel()]));
    }
}
