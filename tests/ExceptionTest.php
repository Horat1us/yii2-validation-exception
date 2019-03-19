<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Horat1us\Yii\Validation;
use yii\base;
use yii\db;

/**
 * Class ExceptionTest
 * @package Horat1us\Yii\Validation\Tests
 */
class ExceptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $model = new base\Model;
        $exception = new Validation\Exception($model);

        $this->assertEquals("yii\base\Model validation errors", $exception->getMessage());
        $this->assertEquals($model, $exception->getModel());
    }

    public function testSuccessfulValidate(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var base\Model|MockObject $model */
        $model = $this->createMock(base\Model::class);

        $model->expects($this->once())
            ->method('validate')
            ->with([], false)
            ->willReturn(true);

        /** @noinspection PhpUnhandledExceptionInspection */
        Validation\Exception::validateOrThrow($model, [], false);
    }

    public function testFailureValidate(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var base\Model|MockObject $model */
        $model = $this->createMock(base\Model::class);

        $model->expects($this->once())
            ->method('validate')
            ->with(null, true)
            ->willReturn(false);

        $this->expectException(Validation\Exception::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        Validation\Exception::validateOrThrow($model);
    }

    public function testAddAndThrow(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var base\Model|MockObject $model */
        $model = $this->createMock(base\Model::class);

        $model->expects($this->once())
            ->method('addError')
            ->with('attribute', 'ErrorTest');

        $this->expectException(Validation\Exception::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        Validation\Exception::addAndThrow("attribute", "ErrorTest", $model);
    }

    public function testFailSaveInvalidRecord(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var db\ActiveRecordInterface|MockObject $record */
        $record = $this->getMockBuilder(db\ActiveRecordInterface::class)
            ->getMockForAbstractClass();

        $record->expects($this->once())
            ->method('save')
            ->with(true, null)
            ->willReturn(false);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unable to throw validation failure for " . get_class($record));

        /** @noinspection PhpUnhandledExceptionInspection */
        Validation\Exception::saveOrThrow($record);
    }

    public function testFailSaveRecord(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var db\ActiveRecord|MockObject $record */
        $record = $this->createMock(db\ActiveRecord::class);

        $record->expects($this->once())
            ->method('save')
            ->with(true, ['attribute',])
            ->willReturn(false);

        $this->expectException(Validation\Exception::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        Validation\Exception::saveOrThrow($record, ['attribute',]);
    }

    public function testSuccessfulSave(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var db\ActiveRecord|MockObject $record */
        $record = $this->createMock(db\ActiveRecord::class);

        $record->expects($this->once())
            ->method('save')
            ->with(true, null)
            ->willReturn(true);

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->assertEquals(
            $record,
            Validation\Exception::saveOrThrow($record)
        );
    }
}
