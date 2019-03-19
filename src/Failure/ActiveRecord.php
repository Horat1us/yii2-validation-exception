<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Failure;

use Horat1us\Yii\Validation;
use yii\db;

/**
 * Trait ActiveRecord
 * @package Horat1us\Yii\Validation\Failure
 *
 * Implementation of
 * @see ActiveRecordInterface
 * for
 * @mixin db\ActiveRecord
 */
trait ActiveRecord
{
    use Model;

    /**
     * @see \yii\db\ActiveRecord::save() should be used in implementation
     * @param string[]|null $attributeNames
     * @throws Validation\Failure
     */
    public function saveOrFail(array $attributeNames = null): void
    {
        if (!$this->save(true, $attributeNames)) {
            throw new Validation\Exception($this, 1);
        }
    }
}
