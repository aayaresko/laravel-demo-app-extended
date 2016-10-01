<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 09.09.16
 * Time: 8:44
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Extra;

use App\Components\Facades\LanguageFacade;
use Illuminate\Http\Request;

trait SiteFeatures
{
    public function updateBrowserTimezoneOffset(Request $request)
    {
        if ($request->ajax()) {
            if ($request->session()->get('browser_timezone_offset')) {
                return response(304);
            }
            $offset = $request->input('timezone_offset');
            $offset *= 60;
            if ($offset > 0) {
                $offset = "-{$offset}";
            } else {
                $offset = abs($offset);
            }
            $request->session()->set('browser_timezone_offset', $offset);
            return response(200);
        }
        return response(404);
    }
}