<?php
namespace Themosis\View;

use ArrayAccess;
use Themosis\View\Engines\IEngine;

class View implements ArrayAccess, IRenderable {

    /**
     * View data(s).
     *
     * @var array
     */
    protected $data;

    /**
     * Define a View instance.
     *
     * @param ViewFactory $factory The view environment.
     * @param Engines\IEngine $engine The view engine.
     * @param string $view The view name.
     * @param string $path The view real path.
     * @param array $data The passed data to the view.
     */
    public function __construct(ViewFactory $factory, IEngine $engine, $view, $path, $data = array())
    {
        $this->data = $data;
    }

    /**
     * Get the evaluated content of the object.
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
    }

    /**
     * Add view data. A user can pass an array of data
     * or a single piece of data by providing its key and
     * its value.
     *
     * @param string|array $key
     * @param mixed $value
     * @return \Themosis\View\View
     */
    public function with($key, $value = null)
    {
        if(is_array($key)){

            $this->data = array_merge($this->data, $key);

        } else {

            $this->data[$key] = $value;

        }

        return $this;
    }

    /**
     * Check if a view data exists.
     *
     * @param string $key The data key name.
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Return a view data value.
     *
     * @param string $key The data key name.
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->data[$key];
    }

    /**
     * Set a view data.
     *
     * @param string $key The data key name.
     * @param mixed $value The data value.
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->with($key, $value);
    }

    /**
     * Remove, unset a view data.
     *
     * @param string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }
}