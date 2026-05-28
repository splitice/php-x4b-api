<?php

$statePath = $_SERVER['X4B_API_STUB_STATE_PATH'] ?? getenv('X4B_API_STUB_STATE_PATH');
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (!is_string($path)) {
    $path = '/';
}

$state = ['hits' => [], 'requests' => []];
if (is_string($statePath) && is_file($statePath)) {
    $decoded = json_decode((string)file_get_contents($statePath), true);
    if (is_array($decoded)) {
        $state = $decoded + $state;
    }
}

$state['hits'][$path] = ($state['hits'][$path] ?? 0) + 1;
$hit = (int)$state['hits'][$path];
$request = [
    'method' => $_SERVER['REQUEST_METHOD'] ?? 'GET',
    'path' => $path,
    'post' => $_POST,
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? '',
    'cookies' => $_COOKIE,
];
$state['requests'][] = $request;

if (is_string($statePath)) {
    file_put_contents($statePath, (string)json_encode($state), LOCK_EX);
}

switch ($path) {
    case '/apiv2/Test/non200':
        http_response_code(418);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'teapot']);
        return;
    case '/apiv2/Test/bad_json':
        header('Content-Type: application/json');
        echo '{"broken":';
        return;
    case '/apiv2/User/login':
        setcookie('x4b_session', 'cookie-' . $hit, ['path' => '/']);
        break;
}

header('Content-Type: application/json');
echo json_encode([
    'path' => $path,
    'method' => $_SERVER['REQUEST_METHOD'] ?? 'GET',
    'post' => $_POST,
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? '',
    'cookies' => $_COOKIE,
    'hit' => $hit,
    'request_count' => count($state['requests']),
]);
