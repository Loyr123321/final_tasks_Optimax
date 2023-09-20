<?php
declare(strict_types=1);

use Codeception\Util\HttpCode;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use Tests\Support\ApiTester;
use Codeception\Example;

class DeleteEmployeeByIncorrectIdCest
{
    /** @dataProvider incorrectDataProvider */
    public function DeleteEmployeeById(ApiTester $apiTester,Example $provider): void
    {
        $apiTester->sendDelete("employee/remove/{$provider['incorrectId']}",[]);
        $apiTester->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $apiTester->seeResponseIsJson();
        $apiTester->seeResponseMatchesJsonType([
            'message'=>'string',
        ]);

    }
    private function incorrectDataProvider(): iterable
    {
        yield [
            'incorrectId' => 12.1,
        ];
        yield [
            'incorrectId' => null,
        ];

        yield [
            'incorrectId' => -1,
        ];

        yield [
            'incorrectId' => true,
        ];
        yield [
            'incorrectId' => '',
        ];

    }



}