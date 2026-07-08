<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Recrée la table cache si elle est absente (fix ShipiiX)
        DB::statement("
            CREATE TABLE IF NOT EXISTS `cache` (
                `key` varchar(255) NOT NULL,
                `value` mediumtext NOT NULL,
                `expiration` int NOT NULL,
                PRIMARY KEY (`key`),
                KEY `cache_expiration_index` (`expiration`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS `cache_locks` (
                `key` varchar(255) NOT NULL,
                `owner` varchar(255) NOT NULL,
                `expiration` int NOT NULL,
                PRIMARY KEY (`key`),
                KEY `cache_locks_expiration_index` (`expiration`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS `cache`');
        DB::statement('DROP TABLE IF EXISTS `cache_locks`');
    }
};
