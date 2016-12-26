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
     * Gets lessons for a category.
     *
     * @param int $categoryId
     * @return array
     */
    public function getCategoryLessons(int $categoryId)
    {
        return $this->get('lessons/' . $categoryId);
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