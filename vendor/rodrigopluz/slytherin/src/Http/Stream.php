<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rodrigopluz\Slytherin\Http;

use Psr\Http\Message\StreamInterface;

/**
 * Stream
 *
 * @package Slytherin
 * @author  Kévin Dunglas <dunglas@gmail.com>
 * @author  Jérémy 'Jejem' Desvages <jejem@phyrexia.org>
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class Stream implements StreamInterface
{
    /**
     * @var array|null
     */
    protected $meta = null;

    /**
     * @var array
     */
    protected $readable = array('r', 'r+', 'w+', 'a+', 'x+', 'c+', 'w+b');

    /**
     * @var integer|null
     */
    protected $size = null;

    /**
     * @var resource|null
     */
    protected $stream = null;

    /**
     * @var array
     */
    protected $writable = array('r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+', 'w+b');

    /**
     * Initializes the stream instance.
     *
     * @param resource|null $stream
     */
    public function __construct($stream = null)
    {
        $this->stream = $stream;
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * @return string
     */
    public function __toString()
    {
        $this->rewind();

        return $this->getContents();
    }

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
    public function close()
    {
        is_null($this->stream) ?: fclose($this->stream);

        $this->detach();
    }

    /**
     * Separates any underlying resources from the stream.
     *
     * @return resource|null
     */
    public function detach()
    {
        $stream = $this->stream;

        $this->meta = null;

        $this->size = null;

        $this->stream = null;

        return $stream;
    }

    /**
     * Returns true if the stream is at the end of the stream.
     *
     * @return boolean
     */
    public function eof()
    {
        return is_null($this->stream) ?: feof($this->stream);
    }

    /**
     * Returns the remaining contents in a string
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getContents()
    {
        if (is_null($this->stream) || ! $this->isReadable()) {
            $message = 'Could not get contents of stream';

            throw new \RuntimeException($message);
        }

        return stream_get_contents($this->stream);
    }

    /**
     * Returns stream metadata as an associative array or retrieve a specific key.
     *
     * @param  string $key
     * @return array|mixed|null
     */
    public function getMetadata($key = null)
    {
        isset($this->stream) && $this->meta = stream_get_meta_data($this->stream);

        $metadata = isset($this->meta[$key]) ? $this->meta[$key] : null;

        return is_null($key) ? $this->meta : $metadata;
    }

    /**
     * Returns the size of the stream if known.
     *
     * @return integer|null
     */
    public function getSize()
    {
        if (is_null($this->size) === true) {
            $stats = fstat($this->stream);

            $this->size = $stats['size'];
        }

        return $this->size;
    }

    /**
     * Returns whether or not the stream is readable.
     *
     * @return boolean
     */
    public function isReadable()
    {
        $mode = $this->getMetadata('mode');

        return in_array($mode, $this->readable);
    }

    /**
     * Returns whether or not the stream is seekable.
     *
     * @return boolean
     */
    public function isSeekable()
    {
        return $this->getMetadata('seekable');
    }

    /**
     * Returns whether or not the stream is writable.
     *
     * @return boolean
     */
    public function isWritable()
    {
        $mode = $this->getMetadata('mode');

        return in_array($mode, $this->writable);
    }

    /**
     * Read data from the stream.
     *
     * @param  integer $length
     * @return string
     *
     * @throws \RuntimeException
     */
    public function read($length)
    {
        $data = fread($this->stream, $length);

        if (! $this->isReadable() || $data === false) {
            $message = 'Could not read from stream';

            throw new \RuntimeException($message);
        }

        return $data;
    }

    /**
     * Seek to the beginning of the stream.
     *
     * @throws \RuntimeException
     */
    public function rewind()
    {
        $this->seek(0);
    }

    /**
     * Seek to a position in the stream.
     *
     * @param integer $offset
     * @param integer $whence
     *
     * @throws \RuntimeException
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        $seek = -1;

        $this->stream && $seek = fseek($this->stream, $offset, $whence);

        if (! $this->isSeekable() || $seek === -1) {
            $message = 'Could not seek in stream';

            throw new \RuntimeException($message);
        }
    }

    /**
     * Returns the current position of the file read/write pointer.
     *
     * @return integer
     *
     * @throws \RuntimeException
     */
    public function tell()
    {
        $position = false;

        $this->stream && $position = ftell($this->stream);

        if (is_null($this->stream) || $position === false) {
            $message = 'Could not get position of pointer in stream';

            throw new \RuntimeException($message);
        }

        return $position;
    }

    /**
     * Write data to the stream.
     *
     * @param  string $string
     * @return integer
     *
     * @throws \RuntimeException
     */
    public function write($string)
    {
        if (! $this->isWritable()) {
            $message = 'Stream is not writable';

            throw new \RuntimeException($message);
        }

        $this->size = null;

        return fwrite($this->stream, $string);
    }
}
