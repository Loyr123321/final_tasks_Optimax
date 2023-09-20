<?php
declare(strict_types=1);

use Codeception\Util\HttpCode;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use Tests\Support\ApiTester;

class GetEmployeeByIdCest
{
    private string $employeeId;

    #[Before('GetEmployeeById')]
    public function precondition(ApiTester $apiTester): void
    {
        $requestBody = [
            'name' => 'Test employee',
            'email' => 'test@test.ru',
            'position' =>'CEO',
            'age'=>20

        ];

        $response = $apiTester->sendPostAsJson('employee/add', $requestBody);

        $apiTester->seeResponseCodeIs(HttpCode::CREATED);

        $this->employeeId = (string) $response['id'];

    }

    public function GetEmployeeById(ApiTester $apiTester): void
    {
        $apiTester->wantToTest('Get employee by id');



        $apiTester->sendGet('employee/' .$this->employeeId,[]);
        $apiTester->seeResponseCodeIs(HttpCode::OK);

        $apiTester->seeResponseIsJson();

        $apiTester->seeResponseContainsJson(
            [
                'id' => (int)$this->employeeId,
                'name' => 'Test employee',
                'email' => 'test@test.ru',
                'position' =>'CEO',
                'age'=>20
            ]

        );

    }

    #[After('GetEmployeeById')]
    public function postcondition(ApiTester $apiTester): void
    {
        $apiTester->sendDelete('employee/remove/' .$this->employeeId,[]);

        $apiTester->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }


}