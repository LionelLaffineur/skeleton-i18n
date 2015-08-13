<?php
/**
 * Language class
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 * @author Gerry Demaret <gerry@tigron.be>
 */

namespace Skeleton\I18n;

use \Skeleton\Database\Database;

class Language {
	use \Skeleton\Object\Model;
	use \Skeleton\Object\Save;
	use \Skeleton\Object\Delete;
	use \Skeleton\Object\Get;

	/**
	 * Language
	 *
	 * @var Language $language
	 * @access private
	 */
	private static $language = null;

	/**
	 * Get by name_short
	 *
	 * @access public
	 * @return Language
	 * @param string $name_short
	 */
	public static function get_by_name_short($name) {
		$db = Database::Get();
		$id = $db->getOne('SELECT id FROM language WHERE name_short=?', [$name]);

		if ($id === null) {
			throw new Exception('No such language');
		}

		return self::get_by_id($id);
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
		return self::$language;
	}
}
