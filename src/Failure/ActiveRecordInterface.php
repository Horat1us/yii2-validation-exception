<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Failure;

use Horat1us\Yii\Validation;
use yii\db;

/**
 * Interface ActiveRecordInterface
 * @package Horat1us\Yii\Validation\Exception
 *
 * Extension for
 * @see db\ActiveRecord
 */
interface ActiveRecordInterface extends ModelInterface
{
    /**
     * @see \yii\db\ActiveRecord::save() should be used in implementation
     * @param string[]|null $attributeNames
     * @throws Validation\Failure
     */
    public function saveOrFail(array $attributeNames = null): void;
}
