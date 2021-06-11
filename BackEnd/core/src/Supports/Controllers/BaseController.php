<?php

namespace Core\Supports\Controllers;

use Arcanedev\SeoHelper\Traits\Seoable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Seoable;

    function __construct()
    {
        // cms_load_widget();
        /**
         * Check if URI contains "public"
         * Remove "public" in URI
         * Redirect to URI without "public"
         */
        $root_domain = request()->root();
        $arrDomain = explode('/', $root_domain);
        if (end($arrDomain) == 'public') {
            unset($arrDomain[count($arrDomain) - 1]);
            $newRoot = implode('/', $arrDomain);
            if (request()->path() == '/') {
                return redirect()->to($newRoot)->send();
            } else {
                return redirect()->to($newRoot . '/' . request()->path())->send();
            }
        }

        $this->seo()
            ->setUrl(url()->current())
            ->setSiteName(setting('site_name', config('cms.site_name')));
    }
}