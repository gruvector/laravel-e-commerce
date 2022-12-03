<?php

namespace Modules\Transaction\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Http\Requests\SaveTransactionRequest;

class TransactionController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'transaction::transactions.transaction';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'transaction::admin.transactions';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveTransactionRequest::class;
}
