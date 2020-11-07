<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AddCustomerScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isAdmin()){
            Customer::addGlobalScope('belongToEmployee', function(Builder $builder) {
                $builder->where('employee_id', auth()->user()->employee->id);
            });
        }
        return $next($request);
    }
}
