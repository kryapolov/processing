<?php

namespace Processing\ObjectPool;

/**
 * Object Pool Storage
 * @author    Konstantin Ryapolov
 * @create    15.02.2014
 *            Class ObjectPool
 * @package   Processing\ObjectPool
 */
class ObjectPool implements ObjectPoolInterface
{

    /** pool array
     * @var    array
     */
    private $pool = array();

    /** max size pool
     * @var    int
     */
    private $maxPoolSize;

    /**
     *
     * @param int $maxPoolSize
     */
    public function __construct($maxPoolSize = 100)
    {
        $this->setMaxPoolSize($maxPoolSize);
    }

    /**
     * {@inheritdoc}
     */
    public function getByKey($key)
    {
        return $this->getByKeyRecursive($key);
    }

    /**
     * {@inheritdoc}
     */
    public function setToPool($key, $value)
    {
        $this->pool[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function removeByKey($key)
    {
        unset($this->pool[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxPoolSize($size)
    {
        $this->maxPoolSize = $size;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxPoolSize()
    {
        return $this->maxPoolSize;
    }

    /**
     * {@inheritdoc}
     */
    public function getPoolSize()
    {
        return count($this->pool);
    }

    /**
     * Get a key value if there is no value to put it in the pull
     *
     * @param string $key index key
     *
     * @return mixed
     */
    private function getByKeyRecursive($key)
    {
        if (!array_key_exists('$key', $this->pool)) {
            if (count($this->pool) >= $this->getMaxPoolSize()) {
                array_shift($this->pool);
            }

            return $this->pool[$key] = $this->constructByKey($key);
        }

        return $this->pool[$key];
    }

    /**
     * Build member of pool
     *
     * @param string $key index key
     *
     * @return mixed new instance of key
     */
    private function constructByKey($key)
    {
        return new $key;
    }

}