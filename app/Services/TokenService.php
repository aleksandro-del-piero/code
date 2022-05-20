<?php


namespace App\Services;

use App\Models\RegisterToken;
use Illuminate\Support\Str;

/**
 * Class TokenService
 * @package App\Services
 */
class TokenService
{
    protected $lifetime;

    public function __construct()
    {
        $this->lifetime = $this->getLifeTimeToken();
    }

    /**
     * Return created token name
     *
     * @return string
     */
    public function create()
    {
        RegisterToken::query()->create([
            'name' => $plainText = Str::random(40),
            'token' => hash('sha256', Str::random(40)),
            'lifetime' => now()->addMinutes($this->lifetime)
        ]);

        return $plainText;
    }

    /**
     * @param $token
     * @return bool
     */
    public function checkRelevance($name): bool
    {
        $tokenFromBase = $this->getTokenFromBase($name);

        if (!$tokenFromBase || $tokenFromBase->lifetime < now()) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    protected function getLifeTimeToken(): int
    {
        return config('token.lifetime');
    }

    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getTokenFromBase($name)
    {
        return RegisterToken::query()
            ->where('name', $name)
            ->where('is_used', RegisterToken::NOT_USED)
            ->first();
    }

    /**
     * @param RegisterToken $token
     * @return bool
     */
    public function setUsed(RegisterToken $token): bool
    {
        return $token
            ->fill(['is_used' => RegisterToken::USED])
            ->save();
    }
}
