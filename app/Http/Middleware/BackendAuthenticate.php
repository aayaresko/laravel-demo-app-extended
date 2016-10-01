<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 22.08.16
 * Time: 14:51
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace app\Http\Middleware;

use Closure;

class BackendAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $administrators = [
            'aayaresko@gmail.com',
            'jdoe@gmail.com',
        ];
        $user = $request->user();
        if (
            (!$user) ||
            (!in_array($user->email, $administrators))
        ) {
            return redirect()->route('frontend.index');
        }

        return $next($request);
    }
}