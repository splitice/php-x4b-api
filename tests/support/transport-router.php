<?php

/**
 * @param mixed $value
 * @return array{hits: array<string, int>, requests: list<array<string, mixed>>}
 */
function normalize_transport_state(mixed $value): array
{
    $state = [
        'hits' => [],
        'requests' => [],
    ];

    if (!is_array($value)) {
        return $state;
    }

    if (isset($value['hits']) && is_array($value['hits'])) {
        foreach ($value['hits'] as $path => $count) {
            if (is_string($path) && is_numeric($count)) {
                $state['hits'][$path] = (int) $count;
            }
        }
    }

    if (isset($value['requests']) && is_array($value['requests'])) {
        foreach ($value['requests'] as $request) {
            if (is_array($request)) {
                $normalizedRequest = [];
                foreach ($request as $key => $item) {
                    if (is_string($key)) {
                        $normalizedRequest[$key] = $item;
                    }
                }
                $state['requests'][] = $normalizedRequest;
            }
        }
    }

    return $state;
}

/**
 * @param mixed $value
 * @return array<string, mixed>
 */
function normalize_request_map(mixed $value): array
{
    if (!is_array($value)) {
        return [];
    }

    $normalized = [];
    foreach ($value as $key => $item) {
        if (is_string($key)) {
            $normalized[$key] = $item;
        }
    }

    return $normalized;
}

/**
 * @return array<string, mixed>
 */
function build_transport_request(string $path): array
{
    $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    if (!is_string($requestMethod)) {
        $requestMethod = 'GET';
    }

    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (!is_string($contentType)) {
        $contentType = '';
    }

    return [
        'authorization' => $_SERVER['HTTP_AUTHORIZATION'] ?? null,
        'method' => $requestMethod,
        'path' => $path,
        'post' => normalize_request_map($_POST),
        'content_type' => $contentType,
        'cookies' => normalize_request_map($_COOKIE),
    ];
}

$statePath = $_SERVER['X4B_API_STUB_STATE_PATH'] ?? getenv('X4B_API_STUB_STATE_PATH');
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
if (!is_string($requestUri)) {
    $requestUri = '/';
}

$path = parse_url($requestUri, PHP_URL_PATH);
if (!is_string($path)) {
    $path = '/';
}

$state = normalize_transport_state(null);
if (is_string($statePath) && is_file($statePath)) {
    $decoded = json_decode((string)file_get_contents($statePath), true);
    $state = normalize_transport_state($decoded);
}

$state['hits'][$path] = ($state['hits'][$path] ?? 0) + 1;
$hit = (int)$state['hits'][$path];
$request = build_transport_request($path);
$state['requests'][] = $request;

if (is_string($statePath)) {
    file_put_contents($statePath, (string)json_encode($state), LOCK_EX);
}

switch ($path) {
    case '/apiv2/Test/forbidden':
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Not Logged In']);
        return;
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
    'authorization' => $_SERVER['HTTP_AUTHORIZATION'] ?? null,
    'path' => $path,
    'method' => $_SERVER['REQUEST_METHOD'] ?? 'GET',
    'post' => $_POST,
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? '',
    'cookies' => $_COOKIE,
    'hit' => $hit,
    'request_count' => count($state['requests']),
]);
