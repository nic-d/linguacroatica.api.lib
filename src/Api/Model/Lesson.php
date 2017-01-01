<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 26/12/2016
 * Time: 00:46
 */

namespace Hrvatski\Api\Model;

/**
 * Class Lesson
 * @package Api\Model
 */
class Lesson extends Api
{
    /**
     * Lesson constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets all lessons.
     *
     * @return array
     */
    public function getLessons()
    {
        return $this->get('lessons');
    }

    /**
     * Get lessons for a module.
     *
     * @param int $moduleId
     * @return array
     */
    public function getModuleLessons(int $moduleId)
    {
        return $this->get('lessons/' . $moduleId);
    }

    /**
     * Gets a lesson.
     *
     * @param string|int $lessonId
     * @return array
     */
    public function getLesson($lessonId)
    {
        if (is_string($lessonId)) {
            return $this->get('lesson/' . $lessonId, [
                'type' => 'hash',
            ]);
        }

        return $this->get('lesson/' . $lessonId);
    }
}