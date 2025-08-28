<?php

namespace App;

class Config {
    // Cached XML configs
    private static ?\SimpleXMLElement $xml = null;

    private static string $file = __DIR__ . '/../Config/config.xml';

    private static function load(): void {
        if (self::$xml === null) {
            $file = self::$file;
            if (!file_exists($file)) {
                throw new \Exception("Config file not found: $file");
            }
            self::$xml = simplexml_load_file($file);
        }
    }

    public static function get(string $path): string {
        self::load();
        $parts = explode('.', $path);

        $value = self::$xml;
        foreach ($parts as $part) {
            if (isset($value->$part)) {
                $value = $value->$part;
            } else {
                throw new \Exception("Config path not found: $path");
            }
        }

        return (string) $value;
    }

    public static function env(): string {
        return self::get('app.environment');
    }

    public static function isDev(): bool {
        return self::env() === 'dev';
    }
}