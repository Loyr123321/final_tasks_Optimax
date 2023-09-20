<?php
declare(strict_types=1);

use Codeception\Util\HttpCode;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use Tests\Support\ApiTester;

class DeleteEmployeeByIdCest
{
    private string $employeeId;
    #[Before('DeleteEmployeeById')]
    public function precondition(ApiTester $apiTester): void
    {
        $requestBody = [
            'name' => 'MaximB',
            'email' => 'maxim123@test.ru',
            'position' =>'CEO',
            'age'=>25

        ];

        $response = $apiTester->sendPostAsJson('employee/add', $requestBody);
        $apiTester->seeResponseCodeIs(HttpCode::CREATED);

        $this->employeeId = (string) $response['id'];

    }
public function DeleteEmployeeById (ApiTester $apiTester):void{

        $apiTester->sendDelete('employee/remove/'.$this->employeeId,[]);
        $apiTester->seeResponseIsJson();
        $apiTester->seeResponseMatchesJsonType([
            "message"=>"string",
        ]);
        $apiTester->seeResponseCodeIs(HttpCode::NO_CONTENT);


}
    #[After('DeleteEmployeeById')]
    public function aftercondition(ApiTester $apiTester): void
    {
        $apiTester->sendGet('employee/'.$this->employeeId,[]);
        $apiTester->seeResponseCodeIs(HttpCode::NOT_FOUND);

    }
}