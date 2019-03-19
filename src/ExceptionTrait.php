<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation;

use yii\base;
use yii\db;

/**
 * Trait ExceptionTrait
 * @package Horat1us\Yii\Validation
 *
 * @see \Failure implementation
 */
trait ExceptionTrait
{
    /** @var base\Model */
    protected $model;

    public function __construct(base\Model $model, int $code = 0, \Throwable $previous = null)
    {
        $message = get_class($model) . " validation errors";
        parent::__construct($message, $code, $previous);

        $this->model = $model;
    }

    public function getModel(): base\Model
    {
        return $this->model;
    }

    /**
     * @throws Failure
     */
    public static function validateOrThrow(
        base\Model $model,
        array $attributeNames = null,
        bool $cleanErrors = true
    ): base\Model {
        if (!$model->validate($attributeNames, $cleanErrors)) {
            throw new static($model);
        }

        return $model;
    }

    /**
     * @throws Failure
     */
    public static function saveOrThrow(
        db\ActiveRecordInterface $record,
        array $attributeNames = null
    ): db\ActiveRecordInterface {
        if (!$record->save(true, $attributeNames)) {
            if (!$record instanceof base\Model) {
                throw new \InvalidArgumentException(
                    "Unable to throw validation failure for " . get_class($record)
                );
            }

            throw new static($record);
        }

        return $record;
    }

    /**
     * @throws Failure=
     */
    public static function addAndThrow(string $attribute, string $error, base\Model $model): void
    {
        $model->addError($attribute, $error);
        throw new static($model);
    }
}
