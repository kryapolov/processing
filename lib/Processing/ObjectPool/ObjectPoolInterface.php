<?php

namespace Processing\ObjectPool;

/**
 * Object Pool Storage
 * @author    Konstantin Ryapolov
 * @create    15.02.2014
 *            Interface ObjectPoolInterface
 * @package   Processing\ObjectPool
 */
interface ObjectPoolInterface
{

    /**
     * Return a value from storage pool
     *
     * @param string $key index key
     *
     * @return object
     */
    public function getByKey($key);

    /**
     * Save the value of the storage pool
     *
     * @param string $key   index key
     * @param mixed  $value stored value
     *
     * @return mixed
     */
    public function setToPool($key, $value);

    /**
     * Remove the value from storage pool
     *
     * @param string $key index key
     *
     * @return mixed
     */
    public function removeByKey($key);

    /**
     * Set the maximum size of the storage pool in records
     *
     * @param int $size max size pool
     *
     * @return mixed
     */
    public function setMaxPoolSize($size);

    /**
     * Get the maximum size of the storage
     * @return int size value
     */
    public function getMaxPoolSize();

    /**
     * Get the actual size of the storage pool
     * @return int size value
     */
    public function getPoolSize();
}