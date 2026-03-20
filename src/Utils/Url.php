<?php
declare(strict_types=1);

namespace App\Utils;
class Url
{
    private function extractSegments(string $requestUri): array
    {
        $path = (string)parse_url($requestUri, PHP_URL_PATH);
        $query = (string)parse_url($requestUri, PHP_URL_QUERY);

        $candidates = [];

        if ($path !== '') {
            $candidates[] = $path;
        }

        if ($query !== '') {
            parse_str($query, $queryParams);

            foreach (['request', 'route', 'path', 'q'] as $key) {
                if (!empty($queryParams[$key]) && is_string($queryParams[$key])) {
                    $candidates[] = $queryParams[$key];
                }
            }

            if (str_contains($query, '/')) {
                $candidates[] = $query;
            }
        }

        foreach ($candidates as $candidate) {
            $segments = $this->normalizeSegments($candidate);

            if (count($segments) >= 4) {
                return array_slice($segments, -4);
            }

            if ($segments !== []) {
                return $segments;
            }
        }

        return [];
    }

    private function normalizeSegments(string $value): array
    {
        $value = str_replace('index.php', '', $value);
        $value = trim($value, " \t\n\r\0\x0B/");

        if ($value === '') {
            return [];
        }

        return array_values(array_filter(
            explode('/', $value),
            static function (string $segment): bool {
                return trim($segment) !== '';
            }
        ));
    }

    public function getExtractSegments(string $requestUri): array
    {
        return $this->extractSegments($requestUri);

    }
}