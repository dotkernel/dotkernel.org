<?php

declare(strict_types=1);


const PAGE_REDIRECTS = [
    '/'                            => 'https://www.dotkernel.com/api',
    '/page/flow-middleware'        => 'https://www.dotkernel.com/architecture/#middleware-flow',
    '/page/flow-libraries'         => 'https://www.dotkernel.com/architecture/#library-flow',
    '/page/flow-libraries-email'   => 'https://www.dotkernel.com/architecture/#library-flow-email',
];

const CATCH_ALL_REDIRECT = 'https://www.dotkernel.com/api/';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rtrim($path, '/') ?: '/';

if (array_key_exists($path, PAGE_REDIRECTS)) {
    header('Location: ' . PAGE_REDIRECTS[$path], true, 301);
    exit;
}

header('Location: ' . CATCH_ALL_REDIRECT, true, 301);
exit;
