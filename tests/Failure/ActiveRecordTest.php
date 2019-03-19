<?php

declare(strict_types=1);

namespace Horat1us\Yii\Validation\Tests\Failure;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Horat1us\Yii\Validation;

/**
 * Class ActiveRecordTest
 * @package Horat1us\Yii\Validation\Tests\Failure
 */
class ActiveRecordTest extends TestCase
{
    public function testSave(): void
    {
        $mock = $this->getMockForRecord();
        $mock->expects($this->once())
            ->method('save')
            ->with(true, ['attribute1'])
            ->willReturn(true);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->saveOrFail(['attribute1']);
    }

    public function testSaveFailure(): void
    {
        $mock = $this->getMockForRecord();
        $mock->expects($this->once())
            ->method('save')
            ->with(true, null)
            ->willReturn(false);

        $this->expectException(Validation\Exception::class);
        $this->expectExceptionCode(1);

        /** @noinspection PhpUnhandledExceptionInspection */
        $mock->saveOrFail();
    }

    /**
     * @return Validation\Failure\ActiveRecord|MockObject
     */
    protected function getMockForRecord()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        /** @var MockObject|Validation\Failure\Model $mock */
        $mock = $this->getMockBuilder(ActiveRecord::class)
            ->setMethods(['save',])
            ->getMock();

        return $mock;
    }
}
