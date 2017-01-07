<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 05/01/2017
 * Time: 08:11
 */

namespace Hrvatski\Api\Model;

/**
 * Class Test
 * @package Hrvatski\Api\Model
 */
class Test extends Api
{
    /**
     * Test constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets all tests.
     *
     * @return array
     */
    public function getTests()
    {
        return $this->get('tests');
    }

    /**
     * Gets a single (specific) module.
     *
     * @param $testId
     * @return array
     */
    public function getTest($testId)
    {
        if (is_string($testId)) {
            return $this->get('test/' . $testId, [
                'type' => 'hash',
            ]);
        }

        return $this->get('test/' . $testId);
    }

    /**
     * Gets the user's answers to a test.
     *
     * @param int $userId
     * @return array
     */
    public function getAnswers(int $userId)
    {
        return $this->get('test/' . $userId . '/answers');
    }

    /**
     * Creates a new test.
     *
     * @param array $data
     * @return array
     */
    public function createTest(array $data)
    {
        return $this->post('test', $data);
    }

    /**
     * Creates test answers for a user.
     *
     * @param int $testId
     * @param array $data
     * @return array
     */
    public function createAnswer(int $testId, array $data)
    {
        return $this->post('test/' . $testId . '/answer', $data);
    }

    /**
     * Updates a test.
     *
     * @param int $testId
     * @param array $data
     * @return array
     */
    public function updateTest(int $testId, array $data)
    {
        return $this->put('test/' . $testId, $data);
    }

    /**
     * Deletes a test.
     *
     * @param int $testId
     * @return array
     */
    public function deleteTest(int $testId)
    {
        return $this->delete('test/' . $testId);
    }
}