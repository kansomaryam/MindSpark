<?php
/**
 * Autoloader function for dynamically loading theme classes and traits in the Aquila theme.
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc\Helpers;

/**
 *
 * @param string $resource The resource namespace to autoload.
 *
 * @return void
 */
function autoloader( $resource = '' ) {
    $resource_path  = false;
    $namespace_root = 'AQUILA_THEME\\';
    $resource       = trim( $resource, '\\' );

    // Bail if the resource is not within the Aquila namespace.
    if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
        return;
    }

    // Remove the namespace root and prepare the path.
    $resource = str_replace( $namespace_root, '', $resource );
    $path = explode(
        '\\',
        str_replace( '_', '-', strtolower( $resource ) )
    );

    // Check if the path contains valid elements.
    if ( empty( $path[0] ) || empty( $path[1] ) ) {
        return;
    }

    // Initialize directory and filename variables.
    $directory = '';
    $file_name = '';

    // Determine the type of resource and set the directory and file name.
    if ( 'inc' === $path[0] ) {
        switch ( $path[1] ) {
            case 'traits':
                $directory = 'traits';
                $file_name = sprintf( 'trait-%s', trim( strtolower( $path[2] ) ) );
                break;

            case 'widgets':
            case 'blocks':
                if ( ! empty( $path[2] ) ) {
                    $directory = sprintf( 'classes/%s', $path[1] );
                    $file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
                }
                break;

            default:
                $directory = 'classes';
                $file_name = sprintf( 'class-%s', trim( strtolower( $path[1] ) ) );
                break;
        }

        // Create the full resource path.
        $resource_path = sprintf( '%s/inc/%s/%s.php', untrailingslashit( AQUILA_DIR_PATH ), $directory, $file_name );
    }

    // Check if the file exists and is valid, then require it.
    $is_valid_file = validate_file( $resource_path );
    if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
        require_once( $resource_path );
    }
}

// Register the autoloader function.
spl_autoload_register( '\AQUILA_THEME\Inc\Helpers\autoloader' );
