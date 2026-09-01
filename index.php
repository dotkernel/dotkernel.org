<?php

declare(strict_types=1);


const PAGE_REDIRECTS = [
    '/'                            => 'https://www.dotkernel.com/',
    '/page/flow-middleware'        => 'https://www.dotkernel.com/#request-lifecycle',
    '/page/flow-libraries'         => 'https://www.dotkernel.com/#components-dot-packages',
    '/page/flow-libraries-email'   => 'https://www.dotkernel.com/#components-dot-packages',
];

const ASSET_PATH_PREFIXES = [
    '/css/',
    '/js/',
    '/fonts/',
    '/images/',
];

const CATCH_ALL_REDIRECT = 'https://www.dotkernel.com/api/';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rtrim($path, '/') ?: '/';

if (array_key_exists($path, PAGE_REDIRECTS)) {
    header('Location: ' . PAGE_REDIRECTS[$path], true, 301);
    exit;
}

foreach (ASSET_PATH_PREFIXES as $prefix) {
    if (str_starts_with($path, $prefix)) {
        http_response_code(410);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Gone';
        exit;
    }
}

header('Location: ' . CATCH_ALL_REDIRECT, true, 301);
exit;
