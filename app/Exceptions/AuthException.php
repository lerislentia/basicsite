<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AuthException extends \Exception
{
    /**
     * @var int
     */
    protected $statusCode = Response::HTTP_UNAUTHORIZED;

    /**
     * Constructor
     * @param string       $message
     * @param integer|null $statusCode
     */
    public function __construct(string $message = 'An error occurred', int $statusCode = 401)
    {
        parent::__construct($message);

        // Si hay codigo de estado
        if (! is_null($statusCode)) {
            $this->setCode($statusCode);
        }
    }

    /**
     * @param integer $statusCode
     */
    public function setCode($statusCode)
    {
        $this->code = $statusCode;
    }
}
