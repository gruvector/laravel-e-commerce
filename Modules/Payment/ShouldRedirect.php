<?php

namespace Modules\Payment;

interface ShouldRedirect
{
    public function getRedirectUrl();
}
