<?php

declare(strict_types=1);

use Codeception\Example;
use Codeception\Util\HttpCode;
use Tests\Support\ApiTester;
use PHPUnit\Framework\Attributes\Before;

class CreateNewEmployeeWithIncorrectDataCest
{

    #[Before('createEmployeeWithIncorrectData')]
    public function precondtion(ApiTester $apiTester): void
    {
        $requestBody = [
            'name' => 'Kirill',
            'email' => 'test1234455@test.ru',
            'position' =>'CEO',
            'age'=>23

        ];

        $apiTester->sendPostAsJson('employee/add', $requestBody);
        $apiTester->seeResponseIsJson();
        $apiTester->seeResponseCodeIs(HttpCode::CREATED);



    }

    /** @dataProvider incorrectDataProvider */
    public function createEmployeeWithIncorrectData(ApiTester $apiTester, Example $provider): void
   {
       $apiTester->wantToTest('Create new employee with incorrect data');
       $apiTester->sendPostAsJson('employee/add', $provider['requestBody']);

       $apiTester->seeResponseCodeIs(HttpCode::BAD_REQUEST);
       $apiTester->seeResponseMatchesJsonType([
          'message'=>'string',
       ]);
    }

    private function incorrectDataProvider(): iterable
    {
        yield [
            'requestBody' => [
                'name' => null,
                'email' => 'test1@test.ru',
                'position' => 'CEO',
                'age' => 23

            ],
        ];

                yield [
                    'requestBody' => [
                        'name' => 123,
                        'email' => 'test2@test.ru',
                        'position' => 'CEO',
                        'age' => 23
                    ]];
                yield [
                    'requestBody' => [
                        'name' => '',
                        'email' => 'test3@test.ru',
                        'position' => 'CEO',
                        'age' => 23
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 1.0,
                        'email' => 'test4@test.ru',
                        'position' => 'CEO',
                        'age' => 23
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Testiy',
                        'email' => 123,
                        'position' => 'CEO',
                        'age' => 23
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Testiy',
                        'email' => null,
                        'position' => 'CEO',
                        'age' => 23
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 123,
                        'email' => '',
                        'position' => 'CEO',
                        'age' => 23
                    ]];

                    yield [
                    'requestBody' => [
                        'name' => 'Mihail',
                        'email' => 'test1234455@test.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Kirill',
                        'email' => '@test.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Kirill',
                        'email' => 'test01@.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Kirill',
                        'email' => '@test.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max',
                        'email' => 'test0@.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max2',
                        'email' => 'test1@test.',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max3',
                        'email' => 'test2test.ru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max4',
                        'email' => 'test3@testru',
                        'position' => 'developer',
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max5',
                        'email' => 'test4testru',
                        'position' => 'developer',
                        'age' => 45
                    ]];


                yield [
                    'requestBody' => [
                        'name' => 'Max6',
                        'email' => 'test5@test.ru',
                        'position' => true,
                        'age' => 45
                    ]];

                yield [
                    'requestBody' => [
                        'name' => 'Max7',
                        'email' => 'test6@test.ru',
                        'position' => null,
                        'age' => 45
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max8',
                        'email' => 'test7@test.ru',
                        'position' => 1,
                        'age' => 45
                    ]];

                yield [
                    'requestBody' => [
                        'name' => 'Max9',
                        'email' => 'test8@test.ru',
                        'position' => "",
                        'age' => 45
                    ]];

                yield [
                    'requestBody' => [
                        'name' => 'Max10',
                        'email' => 'test9@test.ru',
                        'position' => "developer23",
                        'age' => null,
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max11',
                        'email' => 'test10@test.ru',
                        'position' => "developer23",
                        'age' => "32",
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max12',
                        'email' => 'test11@test.ru',
                        'position' => "developer23",
                        'age' => "",
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max13',
                        'email' => 'test12@test.ru',
                        'position' => "developer23",
                        'age' => true,
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max14',
                        'email' => 'test13@test.ru',
                        'position' => "developer23",
                        'age' => -1,
                    ]];

                yield [
                    'requestBody' => [

                        'email' => 'test14@test.ru',
                        'position' => "developer23",
                        'age' => 30,
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max16',

                        'position' => "developer23",
                        'age' => 30,
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max17',
                        'email' => 'test15@test.ru',

                        'age' => 30
                    ]];
                yield [
                    'requestBody' => [
                        'name' => 'Max18',
                        'email' => 'test16@test.ru',
                        'position' => "developer23"
                    ]];
                yield [
                    'requestBody' => [null]
                ];
              yield [
                    'requestBody' => [
                        'name' => 'Max20',
                        'email' => 'test17@test.ru',
                        'position' => "developer23",
                        'age' => 30,
                        'isSinge'=>true,
                    ]];

        yield [
            'requestBody' => [
                'id'=>111111,
                'name' => 'Max21',
                'email' => 'test18@test.ru',
                'position' => "developer23",
                'age' => 30,


            ]];


    }

}