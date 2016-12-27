<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Hrvatski\Api\Model;

/**
 * Class Module
 * @package Hrvatski\Api\Model
 */
class Module extends Api
{
    /**
     * Module constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Get all modules.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->get('modules');
    }

    /**
     * Get a single (specific) module.
     *
     * @param int $moduleId
     * @return array
     */
    public function getModule($moduleId)
    {
        if (is_string($moduleId)) {
            return $this->get('module/' . $moduleId, [
                'type' => 'slug',
            ]);
        }

        return $this->get('module/' . $moduleId);
    }
}