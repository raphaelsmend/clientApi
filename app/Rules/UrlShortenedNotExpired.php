<?php

namespace App\Rules;

use App\Services\ClientService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Container\Container;

class UrlShortenedNotExpired implements Rule
{
    private $container;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $urlService = $this->container->make(ClientService::class);
        return $urlService->isValidUrlShortened($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Shortened URL already use.';
    }
}
