<?php

namespace App\Http\Middleware;

//GLOBAL IMPORT
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

//LOCAL IMPORT
use App\Traits\ResponseTrait;

class CheckPermission
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param $permission
     * @return Response
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        
        if (Auth::check() && Auth::user()->email_verified_at !== null) {
            if (!Auth::user()->can($permission)) {
                return $this->response(response::HTTP_FORBIDDEN, "Unauthorized access.", [], null);
            } else {
                return $next($request);
            }
        }
        
        return $this->response(response::HTTP_FORBIDDEN, "Email not verified or user not authenticated.", [], null);
    }
}
