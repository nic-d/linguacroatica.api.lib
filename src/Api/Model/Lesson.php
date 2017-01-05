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

    /**
     * Creates a new lesson.
     *
     * @param array $data
     * @return array
     */
    public function createLesson(array $data)
    {
        return $this->post('lesson', $data);
    }

    /**
     * Updates a lesson.
     *
     * @param int $lessonId
     * @param array $data
     * @return array
     */
    public function updateLesson(int $lessonId, array $data)
    {
        return $this->put('lesson/' . $lessonId, $data);
    }

    /**
     * Deletes a lesson.
     *
     * @param int $lessonId
     * @return array
     */
    public function deleteLesson(int $lessonId)
    {
        return $this->delete('lesson/' . $lessonId);
    }
}