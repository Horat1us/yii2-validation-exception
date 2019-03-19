<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Tests\Failure;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Horat1us\Yii\Validation;

/**
 * Class ModelTest
 * @package Horat1us\Yii\Validation\Tests\Failure
 */
class ModelTest extends TestCase
{
    public function testValidationFailure(): void
    {
        $mock = $this->getMockForModel();

        $mock->expects($this->once())
            ->method('validate')
            ->with(null, true)
            ->willReturn(false);

        $this->expectException(Validation\Exception::class);
        $this->expectExceptionCode(2);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->validateOrFail();
    }

    public function testCheckFailure(): void
    {
        $mock = $this->getMockForModel();

        $mock->expects($this->once())
            ->method('hasErrors')
            ->with('attribute')
            ->willReturn(true);

        $this->expectException(Validation\Exception::class);
        $this->expectExceptionCode(3);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->checkOrFail('attribute');
    }

    public function testValidationSuccess(): void
    {
        $mock = $this->getMockForModel();

        $mock->expects($this->once())
            ->method('validate')
            ->with([], false)
            ->willReturn(true);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->validateOrFail([], false);
    }

    public function testCheckSuccess(): void
    {
        $mock = $this->getMockForModel();

        $mock->expects($this->once())
            ->method('hasErrors')
            ->with(null)
            ->willReturn(false);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->checkOrFail();
    }

    /**
     * @return Validation\Failure\Model|MockObject
     */
    protected function getMockForModel()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var MockObject|Validation\Failure\Model $mock */
        $mock = $this->getMockBuilder(ActiveRecord::class)
            ->setMethods(['hasErrors', 'validate',])
            ->getMock();

        return $mock;
    }
}
