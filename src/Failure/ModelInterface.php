<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Failure;

use Horat1us\Yii\Validation;
use yii\base;

/**
 * Interface ModelInterface
 * @package Horat1us\Yii\Validation\Exception
 *
 * Extension for
 * @see base\Model
 */
interface ModelInterface
{
    /**
     * This method SHALL validate model or throw failure exception.
     * @see \yii\base\Model::validate() should be used in implementation
     *
     * @param string[]|null $attributeNames
     * @param bool $clearErrors
     *
     * @throws Validation\Failure
     */
    public function validateOrFail(array $attributeNames = null, bool $clearErrors = true): void;

    /**
     * This method SHALL check for errors in model and throw failure exception if they present.
     * @see \yii\base\Model::hasErrors() should be used in implementation
     *
     * @param string|null $attribute
     *
     * @throws Validation\Failure
     */
    public function checkOrFail(string $attribute = null): void;
}
