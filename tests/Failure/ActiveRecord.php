<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Tests\Failure;

use Horat1us\Yii\Validation;
use yii\db;

/**
 * Class ActiveRecord
 * @package Horat1us\Yii\Validation\Tests\Failure
 * @internal
 */
class ActiveRecord extends db\ActiveRecord
{
    use Validation\Failure\ActiveRecord;
}
