<?php
/**
 * Language class
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 * @author Gerry Demaret <gerry@tigron.be>
 * @author David Vandemaele <david@tigron.be>
 */

namespace Skeleton\I18n;

use \Skeleton\Database\Database;

class Language implements LanguageInterface {
	use \Skeleton\Object\Model;
	use \Skeleton\Object\Save;
	use \Skeleton\Object\Delete;
	use \Skeleton\Object\Get;
	use \Skeleton\Object\Cache;

	/**
	 * Language
	 *
	 * @var Language $language
	 * @access private
	 */
	private static $language = null;

	/**
	 * is translatable
	 *
	 * @access public
	 * @return bool $translatable
	 */
	public function is_translatable(): bool {
		return true;
	}

	/**
	 * Get by name_short
	 *
	 * @access public
	 * @return Language
	 * @param string $name_short
	 */
	public static function get_by_name_short($name) {
		if (self::trait_cache_enabled()) {
			try {
				$object = self::cache_get(get_class() . '_' . $name);
				return $object;
			} catch (\Exception $e) {}
		}

		$db = self::trait_get_database();
		$id = $db->get_one('SELECT id FROM language WHERE name_short=?', [$name]);

		if ($id === null) {
			throw new \Exception('No such language');
		}

		$classname = Config::$language_interface;
		return $classname::get_by_id($id);
	}

	/**
	 * Set the current language
	 *
	 * @access public
	 * @param Language $language
	 */
	public static function set(Language $language) {
		self::$language = $language;
	}

	/**
	 * Get the currect language
	 *
	 * @access public
	 * @return Language $language
	 */
	public static function get() {
		if (isset(self::$language) === false) {
			throw new \Exception('Language not set');
		}

		return self::$language;
	}

}
