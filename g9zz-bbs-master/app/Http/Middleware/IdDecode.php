<?php

namespace App\Http\Middleware;

use Closure;
use Vinkla\Hashids\Facades\Hashids;

class IdDecode
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
        $actionName = $request->route()->getName();
        if ($actionName == 'console.user.attach.role') {
            $userId = $request->route()->parameter('userId');
            if ($userId !== (int)$userId ) {
                $userId = Hashids::connection('user')->decode($userId);
                $request->route()->setParameter('userId',$userId[0]);
            }
        }
        return $next($request);
    }
}
