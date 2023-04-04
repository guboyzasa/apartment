<?php

namespace App\Http\Middleware;

use App\Models\CompanyPackage;
use Illuminate\Support\Facades\Auth;

use Closure;
class CheckPackageReport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cp = CompanyPackage::with('package')->where('is_fn_report')->where('company_id', Auth::user()->company_id)->orderBy('id', 'desc')->first();
        if(!$cp || !$cp->package->is_fn_report == 1){
            return redirect()->route('select-package.index')->withErrors('Package ของคุณไม่มีสิทธิ์เข้าถึง');
        }
        return $next($request);
    }
}
