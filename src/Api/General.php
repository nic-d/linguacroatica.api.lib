<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:19
 */

namespace Hrvatski\Api\Model;

/**
 * Class GeneralApi
 * @package Hrvatski\Api\Model
 */
class General extends Api
{
    /**
     * General constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }
}