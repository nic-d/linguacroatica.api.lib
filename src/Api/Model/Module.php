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

    /**
     * Creates a new module.
     *
     * @param array $data
     * @return array
     */
    public function createModule(array $data)
    {
        return $this->post('module', $data);
    }

    /**
     * Updates a module.
     *
     * @param int $moduleId
     * @param array $data
     * @return array
     */
    public function updateModule(int $moduleId, array $data)
    {
        return $this->put('module/' . $moduleId, $data);
    }

    /**
     * Deletes a module.
     *
     * @param int $moduleId
     * @return array
     */
    public function deleteModule(int $moduleId)
    {
        return $this->delete('module/' . $moduleId);
    }
}