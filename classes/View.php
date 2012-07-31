<?php
/**
 * @author Roman Chvanikoff <chvanikoff@gmail.com>
 * @year 2012
 */

class View extends Kohana_View {

	/**
	 * Default views path
	 */
	const PATH = 'views';

	/**
	 * Template name
	 *
	 * @var string|null
	 */
	private static $template = NULL;

	/**
	 * Getter/setter for template name
	 *
	 * @static
	 * @param null $name template name
	 * @return string|null
	 */
	public static function template($name = NULL)
	{
		if ($name !== NULL)
		{
			View::$template = $name;
		}

		return View::$template;
	}

	/**
	 * Get views path taking template value into a count
	 *
	 * @static
	 * @return string
	 */
	public static function get_path()
	{
		$path = View::PATH;
		$tpl = View::template();
		($tpl === NULL) OR ($path .= '/'.$tpl);

		return $path;
	}

	/**
	 * Sets the view filename.
	 *
	 *     $view->set_filename($file);
	 *
	 * @param   string  $file   view filename
	 * @return  View
	 * @throws  View_Exception
	 */
	public function set_filename($file)
	{
		if (($path = Kohana::find_file(View::get_path(), $file)) === FALSE)
		{
			throw new View_Exception('The requested view :file could not be found in :location', array(
				':file' => $file,
				':location' => View::get_path(),
			));
		}

		// Store the file path locally
		$this->_file = $path;

		return $this;
	}
}