<?php
/**
 * WHMCS Themely Addon Module
 *
 * @copyright Copyright (c) 2021 inVenture Group DBA Themely
 */
/**
 * Require any libraries needed for the module to function.
 * require_once __DIR__ . '/path/to/library/loader.php';
 *
 * Also, perform any initialization required by the service's library.
 */

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Define addon module configuration parameters.
 */
function themely_config() {
    return [
        // Display name for your module
        'name' => 'Themely',
        // Description displayed within the admin interface
        'description' => 'Sell more WordPress hosting services and help your customers build stunning WordPress sites quickly and easily with our free themes directory, one-click installer and onboarding features.',
        // Module author name
        'author' => 'Themely',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0'
    ];
}

/**
 * Activate.
 */
function themely_activate() {
    // Create custom tables and schema required by your module
    try {
        Capsule::schema()
            ->create(
                'mod_themely',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->text('themely');
                }
            );

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'Module activated!',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to activate module: ' . $e->getMessage(),
        ];
    }
}

/**
 * Deactivate.
 */
function themely_deactivate() {
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('mod_themely');

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'Module deactivated!',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to deactivate module: {$e->getMessage()}",
        ];
    }
}