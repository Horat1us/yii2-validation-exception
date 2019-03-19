<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation;

/**
 * Class Exception
 * @package Horat1us\Yii\Validation
 */
class Exception extends \Exception implements Failure
{
    use ExceptionTrait;
}
