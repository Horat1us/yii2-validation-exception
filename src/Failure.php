<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation;

use yii\base;

/**
 * Interface Failure
 * @package Horat1us\Yii\Validation
 */
interface Failure extends \Throwable
{
    public function getModel(): base\Model;
}
