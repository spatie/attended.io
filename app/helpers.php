<?php

use Faker\Factory;
use Faker\Generator;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

function faker(): Generator
{
    return Factory::create();
}

function ok(): Response
{
    return response('', SymfonyResponse::HTTP_NO_CONTENT);
}

function formValue(
    string $property,
    object $object = null,
    ?string $objectProperty = null,
    ?string $defaultValue = null
): ?string {
    $property = preg_replace('/\[(.+)\]/U', '.$1', $property);

    if (! $object) {
        return old($property, $defaultValue);
    }

    $objectProperty = $objectProperty ?? $property;

    return old($property, $object->{$objectProperty} ?? $defaultValue);
}

function present_url(string $url): string
{
    if (! str_contains($url, '://')) {
        return $url;
    }

    [$protocol, $presentableUrl] =  explode('://', $url);

    return $presentableUrl;
}
