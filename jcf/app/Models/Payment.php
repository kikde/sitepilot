<?php

namespace App\Models;

use Modules\User\Entities\Payment as BasePayment;

class Payment extends BasePayment
{
    // Intentionally left empty.
    // This keeps old "use App\Models\Payment" working,
    // but all logic/fillable lives in the module model.
}
