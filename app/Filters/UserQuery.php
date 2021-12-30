<?php
namespace App\Filters;

use App\Models\User\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserQuery  extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if(!$subject)
            $subject = User::query();

        parent::__construct($subject, $request);
    }
}
