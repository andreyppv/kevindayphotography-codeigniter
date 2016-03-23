<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends BF_Model
{
	protected $table		= 'settings';
	protected $key			= 'name';

	/**
	 * Set the created time automatically on a new record
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected $set_created = FALSE;

	/**
	 * Set the modified time automatically on editing a record
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected $set_modified = FALSE;

	//--------------------------------------------------------------------


	/**
	 * A convenience method that combines a where() and find_all()
	 * call into a single call.
	 *
	 * @access public
	 *
	 * @param string $field The table field to search in.
	 * @param string $value The value that field should be.
	 *
	 * @return array
	 */
	public function find_all_by($field=NULL, $value=NULL)
	{
		if (empty($field)) return FALSE;

		// Setup our field/value check
		$this->db->where($field, $value);

		$results = $this->find_all();

		$return_array = array();

		if (is_array($results) && count($results))
		{
			foreach ($results as $record)
			{
				$return_array[$record->name] = $record->value;
			}
		}

		return $return_array;

	}//end find_all_by()

}//end Settings_model
