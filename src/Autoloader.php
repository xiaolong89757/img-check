<?php

/**
 * Autoloader
 */
class Autoloader
{

	/** @var bool */
	protected static $registered = false;

	/**
	 * Register the autoloader in the SPL autoloader
	 *
	 * @return void
	 * @throws Exception If there was an error in registration
	 */
	public static function register()
	{
		if (self::$registered) {
			return;
		}

		if (!spl_autoload_register(['Autoloader', 'loadClass'])) {
			throw new Exception('Unable to register Less_Autoloader::loadClass as an autoloading method.');
		}

		self::$registered = true;
	}

	/**
	 * Unregister the autoloader
	 *
	 * @return void
	 */
	public static function unregister()
	{
		spl_autoload_unregister(['Autoloader', 'loadClass']);
		self::$registered = false;
	}

	/**
	 * Load the class
	 *
	 * @param string $className The class to load
	 */
	public static function loadClass($className)
	{
		$fileName = __DIR__ . DIRECTORY_SEPARATOR .  $className . '.php';

		require $fileName;
		return true;
	}
}
