<?php
declare(strict_types=1);

use Codeception\Util\HttpCode;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use Tests\Support\ApiTester;

class CreateNewEmployeeCest
{
    private string $employeeId;


    public function CreateNewEmployee(ApiTester $apiTester): void
    {
        $requestBody = [
            'name' => 'Kirill',
            'email' => 'test123@test.ru',
            'position' =>'CEO',
            'age'=>23

        ];

        $response = $apiTester->sendPostAsJson('employee/add', $requestBody);
        $apiTester->seeResponseIsJson();
        $apiTester->seeResponseCodeIs(HttpCode::CREATED);

        $this->employeeId = (string) $response['id'];

    }

    #[After('CreateNewEmployee')]
    public function aftercondition(ApiTester $apiTester): void
    {
        $apiTester->sendGet('employee/' .$this->employeeId,[]);
        $apiTester->seeResponseContainsJson(
            [
                'id' => (int)$this->employeeId,
                'name' => 'Kirill',
                'email' => 'test123@test.ru',
                'position' =>'CEO',
                'age'=>23
            ]

        );

    }
}