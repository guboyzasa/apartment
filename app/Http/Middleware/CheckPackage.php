<?php

namespace App\Http\Middleware;

use App\Models\CompanyPackage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Closure;
class CheckPackage 
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
        $p_end = strtotime(Auth::user()->company->companyPackage->package_end);

        if(time() >= $p_end){
            return redirect()->route('select-package.index')->withErrors('แพ็คเกจของคุณหมดอายุแล้ว กรุณาสมัครแพ็คเกจใหม่เพื่อการใช้งานอย่างต่อเนื่อง');
        }
        return $next($request);
    }
}
