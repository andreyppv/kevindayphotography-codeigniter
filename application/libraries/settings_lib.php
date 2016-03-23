<?php  defined('BASEPATH') or exit('No direct script access allowed');

class Settings_lib
{

	/**
	 * A pointer to the CodeIgniter instance.
	 *
	 * @access protected
	 *
	 * @var object
	 */
	protected $ci;

	/**
	 * Settings cache
	 *
	 * @access private
	 *
	 * @var	array
	 */
	private static $cache = array();

	//--------------------------------------------------------------------

	/**
	 * The Settings Construct retrieves all settings and stores them
	 * in the setting cache
	 *
	 * @return void
	 */
	public function __construct()
	{

		$this->ci =& get_instance();
		$this->ci->load->model('setting_model');

		$this->find_all();

	}//end __construct()

	// ------------------------------------------------------------------------

	/**
	 * Gets the setting value requested
	 *
	 * @access public
	 *
	 * @param string $name The name of the setting record to retrieve
	 */
	public function __get($name)
	{
		return self::get($name);

	}//end __get

	// ------------------------------------------------------------------------

	/**
	 * Sets the setting value requested
	 *
	 * @access public
	 *
	 * @param string $name  The name of the setting
	 * @param string $value The value to save
	 *
	 * @return bool
	 */
	public function __set($name, $value)
	{
		return self::set($name, $value);

	}//end __set

	// ------------------------------------------------------------------------

	/**
	 * Retrieves a setting.
	 *
	 * @access public
	 * @static
	 *
	 * @param string $name The name of the item to retrieve
	 *
	 * @return bool
	 */
	public static function item($name)
	{
		$ci =& get_instance();

		if(isset(self::$cache[$name]))
		{
			return self::$cache[$name];
		}

		$setting = $ci->setting_model->find_by('name', $name);

		// Setting doesn't exist, maybe it's a config option
		$value = $setting ? $setting->value : config_item($name);

		// Store it for later
		self::$cache[$name] = $value;

		return $value;

	}//end item()

	// ------------------------------------------------------------------------

	/**
	 * Sets a config item
	 *
	 * @access public
	 * @static
	 *
	 * @param string $name   Name of the setting
	 * @param string $value  Value of the setting
	 * @param string $module Name of the module
	 *
	 * @return bool
	 */
	public static function set($name, $value, $module='core')
	{
		$ci =& get_instance();

		if (isset(self::$cache[$name]))
		{
			$setting = $ci->setting_model->update_where('name', $name, array('value' => $value));
		}
		else
		{
			// insert
			$data = array(
				'name'   => $name,
				'value'  => $value,
				'module' => $module,
			);

			$setting = $ci->setting_model->insert($data);
		}

		self::$cache[$name] = $value;

		return TRUE;

	}//end set()

	// ------------------------------------------------------------------------

	/**
	 * Delete config item
	 *
	 * @access public
	 * @static
	 *
	 * @param string $name   Name of the setting
	 * @param string $module Name of the module
	 *
	 * @return bool
	 */
	public static function delete($name, $module='core')
	{
		$ci =& get_instance();

		if (isset(self::$cache[$name]))
		{
			$data = array(
				'name'   => $name,
				'module' => $module,
			);

			if ($ci->setting_model->delete_where($data))
			{
				unset(self::$cache[$name]);

				return TRUE;
			}
		}

		return FALSE;

	}//end delete()

	// ------------------------------------------------------------------------

	/**
	 * Gets all the settings
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function find_all()
	{
		if(self::$cache)
		{
			return self::$cache;
		}

		$settings = $this->ci->setting_model->find_all();

		foreach($settings as $setting)
		{
			self::$cache[$setting->name] = $setting->value;
		}

		return self::$cache;

	}//end find_all()

	// ------------------------------------------------------------------------

	/**
	 * Find By
	 *
	 * Gets setting for specific search criteria. For multiple matches, see
	 * find_all_by.
	 *
	 * @access public
	 *
	 * @param string $field Setting column name
	 * @param string $value Value ot match
	 *
	 * @return	array
	 */
	public function find_by($field=null, $value=null)
	{

		$settings = $this->ci->setting_model->find_by($field, $value);

		foreach($settings as $setting)
		{
			//self::$cache[$setting['name']] = $setting['value'];
		}

		return $settings;

	}//end find_by()

	// ------------------------------------------------------------------------

	/**
	 * Find All By
	 *
	 * Gets all the settings based on search criteria. For a single setting
	 * match, see find_by
	 *
	 * @see find_by
	 *
	 * @param string $field Setting column name
	 * @param string $value Value ot match
	 *
	 * @return array
	 */
	public function find_all_by($field=null, $value=null)
	{

		$settings = $this->ci->setting_model->find_all_by($field, $value);

		if (is_array($settings) && count($settings))
		{
			foreach($settings as $key => $value)
			{
				self::$cache[$key] = $value;
			}
		}

		return $settings;

	}//end find_all_by()


}//end Settings_lib

// ------------------------------------------------------------------------
// ! HELPER METHOD BELOW
// ------------------------------------------------------------------------

if ( ! function_exists('settings_item'))
{
	/**
	 * Helper method to retrieve a setting.
	 *
	 * @param string $name The name of the item to retrieve
	 *
	 * @return bool|string Returns result of setting or false if none.
	 */
	function settings_item($name = NULL)
	{
		if ($name === NULL)
		{
			return FALSE;
		}

		return Settings_lib::item($name);
	}//end settings_item()

}


/* End of class Settings.php */
/* End of file application/core_modules/settings/libraries/Settings.php */