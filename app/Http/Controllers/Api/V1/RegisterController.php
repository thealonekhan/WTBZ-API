<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Frontend\Access\User\UserRepository;
use Config;
use Illuminate\Http\Request;
use Validator;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username'              => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:4'
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        
        $user = $this->repository->create($request->all());
        
        $this->addZumhiCacheUser($user);

        if (!Config::get('api.register.release_token')) {
            return $this->respondCreated([
                'message'  => trans('api.messages.registeration.success'),
            ]);
        }

        $passportToken = $user->createToken('API Access Token');

        // Save generated token
        $passportToken->token->save();

        $token = $passportToken->accessToken;


        return $this->respondCreated([
            'message'   => trans('api.messages.registeration.success'),
            'token'     => $token,
        ]);
    }

    public function addZumhiCacheUser($user)
    {
        $zumhicacheuser = new ZumhiCacheUser();
        $zumhicacheuser->referenceCode = strtoupper(Str::random(8));
        $zumhicacheuser->user_id = $user->id;
        $zumhicacheuser->membership_id = 2;
        $zumhicacheuser->joinedDateUtc = Carbon::now();
        $zumhicacheuser->coordinates_id = 1;
        $zumhicacheuser->save();
    }
}
