<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\OauthToken;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    //
    public function redirect(Request $request)
    {
        if(!empty(\Cookie::get('access_token'))){
            // $access_token = \Cookie::get('access_token');
            // $token = OauthToken::where('access_token', '=', $access_token)->first();
            // $user = User::where('server_user_id','=',$token->server_user_id)->first();
            // Auth::login($user,true);
            // return redirect("Home");
            $queries = http_build_query(
                [
                    'client_id' => env('OAUTH_SERVER_ID'),
                    'redirect_uri' => env('OAUTH_SERVER_REDIRECT_URI'),
                    'response_type' => 'code',
                ]
            );
            return redirect( env('OAUTH_SERVER_URI') .'/oauth/authorize?' . $queries);

        }else{
            $queries = http_build_query(
                [
                    'client_id' => env('OAUTH_SERVER_ID'),
                    'redirect_uri' => env('OAUTH_SERVER_REDIRECT_URI'),
                    'response_type' => 'code',
                ]
            );

            return redirect( env('OAUTH_SERVER_URI') .'/oauth/authorize?' . $queries);
        }

    }

    public function callback(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        $response = $http->post(env('OAUTH_SERVER_URI') . '/oauth/token', [
            'form_params' => [
                 'grant_type' => 'authorization_code',
                 'client_id' => env('OAUTH_SERVER_ID'),
                 'client_secret' => env('OAUTH_SERVER_SECRET'),
                 'redirect_uri' => env('OAUTH_SERVER_REDIRECT_URI'),
                 'code' => $request->code,
            ],
        ]);
        $body = json_decode((string)$response->getBody(), true);
        \Cookie::queue(\Cookie::make('access_token', $body['access_token'] , time() + 60 * 60 * 24 * 30));
        $response = $http->get(env('OAUTH_SERVER_URI') . '/api/user', [
            'headers' => [
                'Authorization' => 'Bearer ' . $body['access_token'],
            ],
        ]);
        $user_inf = json_decode((string) $response->getBody(), true);
        $finduser = User::where('server_user_id', '=', $user_inf['id'])->first();
        if($finduser == null){
            OauthToken::create([
                'server_user_id' => $user_inf['id'],
                'expires_in' => Carbon::now()->addSecond($body['expires_in']),
                'access_token' => $body['access_token'],
                'refresh_token' => $body['refresh_token'],
            ]);
            $newuser = User::create( [
                'name' => $user_inf['name'],
                'email' => $user_inf['email'],
                'password' => bcrypt('123456dummy'),
                'role' => 0,
                'server_user_id' => $user_inf['id'],
            ]);
            // lưu thông tin để có thể login
            auth::login($newuser,true);
        }else{
            $token = OauthToken::where('server_user_id','=',$user_inf['id'])->first();
            $token->update([
                'expires_in' => Carbon::now()->addSecond($body['expires_in']),
                'access_token' => $body['access_token'],
                'refresh_token' => $body['refresh_token'],
            ]);
            auth::login($finduser,true);
        }
        return redirect('home');
    }

    public function refresh(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        $response = $http->post(env('OAUTH_SERVER_URI') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->user()->tokens->refresh_token,
                'client_id' => env('OAUTH_SERVER_ID'),
                'client_secret' => env('OAUTH_SERVER_SECRET'),
                'redirect_uri' => env('OAUTH_SERVER_REDIRECT_URI'),
            ],
        ]);
        $body = json_decode((string)$response->getBody(), true);
        $request->user()->tokens()->update([
            'expires_in' => Carbon::now()->addSecond($body['expires_in']),
            'access_token' => $body['access_token'],
            'refresh_token' => $body['refresh_token'],
        ]);
        \Cookie::queue(\Cookie::make('access_token', $body['access_token'] , time() + 60 * 60 * 24 * 30));
        $action = \Cookie::get('action');
        \Cookie::queue(\Cookie::forget('action'));
        return redirect($action);
    }
}
