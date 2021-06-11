<?php

namespace Core\Middleware;

use Closure;
use DashboardMenu;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        if (!$guards) {
            DashboardMenu::init($request->user());
            $route = $request->route()->getAction();
            $flag = Arr::get($route, 'permission', Arr::get($route, 'as'));

            if ($flag && !user_check_permission((array) $flag)) {
                // JSON: Ajax or API
                if ($request->expectsJson()) {
                    return response()->json(['status' => false, 'msg' => trans('core::notification.no_permission')]);
                }
                // If not had permission access to dashboard => redirect home index
                if (!user_check_permission('dashboard')) {
                    return redirect()->route('index');
                }
                // redirect to dashboard
                return redirect()->route('dashboard')->with('flash_data', ['type' => 'error', 'message' => trans('core::notification.no_permission')]);
            }
        }
        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (
                $request->is(config('cms.admin_prefix') . '/*') ||
                $request->is(config('cms.admin_prefix'))
            ) {
                return route('user.admin.login', ['redirect_to' => base64_encode(url()->current())]);
            }
            return route('user.login', ['redirect_to' => base64_encode(url()->current())]);
        }
    }
}
