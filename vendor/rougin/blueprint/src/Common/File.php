<?php

namespace Rougin\Blueprint\Common;

/**
 * File
 *
 * A simple object-oriented interface for handling files.
 * NOTE: To be removed in v1.0.0.
 *
 * @package Blueprint
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class File
{
    /**
     * @var resource
     */
    protected $file;

    /**
     * @var string
     */
    protected $path;

    /**
     * Initializes the file instance.
     *
     * @param string $path
     * @param string $mode
     */
    public function __construct($path, $mode = 'wb')
    {
        $this->path = $path;

        $this->file = fopen($path, $mode);
    }

    /**
     * Closes an open file pointer.
     *
     * @return boolean
     */
    public function close()
    {
        return fclose($this->file);
    }

    /**
     * Reads entire file into a string.
     *
     * @return string
     */
    public function getContents()
    {
        return file_get_contents($this->path);
    }

    /**
     * Writes a string to a file.
     *
     * @param  string $content
     * @return integer|boolean
     */
    public function putContents($content)
    {
        return file_put_contents($this->path, $content);
    }

    /**
     * Changes the file mode of the file.
     *
     * @param  integer $mode
     * @return boolean
     */
    public function chmod($mode)
    {
        return chmod($this->path, $mode);
    }
}
