<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 25.08.16
 * Time: 12:28
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Entities\ChatMessage;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LiveChatController extends Controller
{
    public function index()
    {
        $account = Auth::user();
        $token = JWT::encode(['id' => $account->id], env('JWT_SECRET', 'none'));
        Cookie::queue('token', $token, null, null, null, false, false);

        $messages = ChatMessage::all();

        return view('frontend.live-chat.index', ['account' => $account, 'profile' => $account->profile, 'messages' => $messages]);
    }
}