<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Failure;

use Horat1us\Yii\Validation;
use yii\base;

/**
 * Trait Model
 * @package Horat1us\Yii\Validation\Exception
 *
 * Implementation of
 * @see ModelInterface
 * for
 * @mixin base\Model
 */
trait Model
{
    /**
     * @see ModelInterface::validateOrFail() implementation
     *
     * @param string[]|null $attributeNames
     * @param bool $clearErrors
     *
     * @throws Validation\Exception
     */
    public function validateOrFail($attributeNames = null, $clearErrors = true): void
    {
        if (!$this->validate($attributeNames, $clearErrors)) {
            throw new Validation\Exception($this, 2);
        }
    }

    /**
     * @see ModelInterface::checkOrFail() implementation
     * @throws Validation\Exception
     */
    public function checkOrFail(string $attribute = null): void
    {
        if ($this->hasErrors($attribute)) {
            throw new Validation\Exception($this, 3);
        }
    }
}
