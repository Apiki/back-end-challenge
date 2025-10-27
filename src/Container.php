<?php

/**
 * Service container.
 *
 * PHP version 7.4+
 *
 * Simple dependency injection container.
 *
 * @category Challenge
 * @package  App
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Container class.
 *
 * Simple service container for dependency injection.
 *
 * @category Challenge
 * @package  App
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Container
{
    private array $_services = [];
    private array $_singletons = [];

    /**
     * Register a service.
     *
     * @param string   $id        Service identifier.
     * @param callable $factory   Service factory function.
     * @param bool     $singleton Whether to cache the instance.
     *
     * @return void
     */
    public function register(
        string $id,
        callable $factory,
        bool $singleton = true
    ): void {
        $this->_services[$id] = [
            "factory" => $factory,
            "singleton" => $singleton,
        ];
    }

    /**
     * Get a service.
     *
     * @param string $id Service identifier.
     *
     * @return mixed The service instance.
     *
     * @throws RuntimeException If service is not registered.
     */
    public function get(string $id)
    {
        if (!isset($this->_services[$id])) {
            throw new \RuntimeException("Service not found: {$id}");
        }

        $service = $this->_services[$id];

        if ($service["singleton"] && isset($this->_singletons[$id])) {
            return $this->_singletons[$id];
        }

        $instance = call_user_func($service["factory"], $this);

        if ($service["singleton"]) {
            $this->_singletons[$id] = $instance;
        }

        return $instance;
    }

    /**
     * Check if service exists.
     *
     * @param string $id Service identifier.
     *
     * @return bool True if service exists.
     */
    public function has(string $id): bool
    {
        return isset($this->_services[$id]);
    }
}
