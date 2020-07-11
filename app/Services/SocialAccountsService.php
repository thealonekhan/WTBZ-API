<?php
namespace App\Services;
use App\Models\Access\User\User;
use App\Models\Access\User\SocialLogin;
use Laravel\Socialite\Two\User as ProviderUser;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SocialAccountsService
{
    /**
     * Find or create user instance by provider user instance and provider name.
     * 
     * @param ProviderUser $providerUser
     * @param string $provider
     * 
     * @return User
     */
    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = SocialLogin::where('provider', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();
        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;
            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }
            if (! $user) {
                $user = User::create([
                    'first_name' => $providerUser->getName(),
                    'last_name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
                $this->addZumhiCacheUser($user);
            }
            $user->providers()->create([
                'provider_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);
            return $user;
        }
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