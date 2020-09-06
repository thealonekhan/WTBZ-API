<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Http\Request;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Access\User\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Validator;
use Config;
use Exception;

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
    
    /**
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function social_register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'access_token' => 'required',
            'provider' => [
                'required',
                Rule::in(['google', 'facebook']),
            ],
            ]);
            
            if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        
        $provider_response = $this->fetch_provider($request->all());
        
        if (!empty($provider_response)) {
            
            if ($provider_response['statusCode'] == 200) {
                $data = $provider_response['results'];
                $email = $data['email'];
                $firstLastName = explode(' ', $data['name']);
                $fistName = !empty($firstLastName[0]) ? $firstLastName[0] : ''; 
                $lastName = !empty($firstLastName[1]) ? $firstLastName[1] : ''; 
                $message = trans('api.messages.login.success');
                
                $user = User::where('email', $email)->first();
                if (!$user) {
                    // $user = new User();
                    // $user->first_name = $fistName;
                    // $user->last_name = $lastName;
                    // $user->email = $email;
                    // $user->save();

                    $user = $this->repository->createSocial([
                        'first_name' => $fistName,
                        'last_name' => $lastName,
                        'email' => $email,
                    ], true);

                    $message = trans('api.messages.registeration.success');
                    $this->addZumhiCacheUser($user);
                }

                $passportToken = $user->createToken('API Access Token');
        
                // Save generated token
                $passportToken->token->save();
                
                $token = $passportToken->accessToken;
                
                return $this->respondCreated([
                    'message'   => $message,
                    'token'     => $token,
                ]);
        

            }

            return $this->respondWithErrorSocial($provider_response['error'], $provider_response['statusCode']);
            
        }

        return $this->respondWithErrorSocial(trans('api.messages.login.failed'), 422);

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

    public function fetch_provider($request)
    {
        $data = []; 
        $url = '';
        $query = [];

        if ($request['provider'] == 'facebook') {
            $url = config('social-cred.facebook.graphUrl').config('social-cred.facebook.version').'/me';
            $query = [
                'access_token' => $request['access_token'],
                'fields' => implode(',', config('social-cred.facebook.fields')) 
            ];
        }

        if ($request['provider'] == 'google') {
            $url = config('social-cred.google.baseUrl');
            $query = [
                'id_token' => $request['access_token']
            ];
        }

        try{
            $http = new \GuzzleHttp\Client;
            $response = $http->get($url, [
                'query' => $query,
            ]);
            $data['statusCode'] =  $response->getStatusCode();
            $data['results'] = json_decode($response->getBody(), true);
        } catch (Exception $exception) {
            $data['statusCode'] = 422;
            $data['error'] = 'invalid_token';
        }

        return $data;
    }
}
