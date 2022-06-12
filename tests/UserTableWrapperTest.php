<?php

use App\UserTableWrapper;
use PHPUnit\Framework\TestCase;

class UserTableWrapperTest extends TestCase
{
    protected UserTableWrapper $userTableWrapper;

    protected function setUp(): void
    {
        $this->userTableWrapper = new UserTableWrapper();
    }

    protected function tearDown(): void
    {
        unset($userTableWrapper);
    }

    /**
     * @dataProvider providerInsert
     */
    public function testInsert($input, $expected): void
    {
        $this->userTableWrapper->insert($input);
        $this->assertEquals($expected,  $this->userTableWrapper->get());
    }

    public function providerInsert(): array
    {
        return [
          [
              ['name' => "Магазин \"Солнышко\""],
              [0 =>['name' => "Магазин \"Солнышко\""]]
          ],
          [
              ['name' => "Магазин \"Призма\""],
              [0 => ['name' => "Магазин \"Призма\""]]
          ],
          [
              ['name' => "Магазин \"Рассвет\""],
              [0 => ['name' => "Магазин \"Рассвет\""]]
          ]
        ];
    }

    /**
     * @dataProvider providerUpdate
     */
    public function testUpdate($id, $values, $expected): void
    {
        $this->userTableWrapper->insert(['name' => "Магазин \"Богатырь\""]);
        $this->userTableWrapper->update($id, $values);
        $this->assertEquals($expected,  $this->userTableWrapper->get());
    }

    public function providerUpdate(): array
    {
        return [
            [
                0,
                ['name' => "Магазин \"Солнышко\""],
                [0 =>['name' => "Магазин \"Солнышко\""]]
            ],
            [
                0,
                ['name' => "Магазин \"Призма\""],
                [0 => ['name' => "Магазин \"Призма\""]]
            ],
            [
                0,
                ['name' => "Магазин \"Рассвет\""],
                [0 => ['name' => "Магазин \"Рассвет\""]]
            ]
        ];
    }

    /**
     * @dataProvider providerDelete
     */
    public function testDelete($id, $input, $expected): void
    {
        $this->userTableWrapper->insert($input);
        $this->userTableWrapper->delete($id);
        $this->assertEquals($expected,  $this->userTableWrapper->get());
    }

    public function providerDelete(): array
    {
        return [
            [
                0,
                ['name' => "Магазин \"Солнышко\""],
                []
            ],
            [
                0,
                ['name' => "Магазин \"Призма\""],
                []
            ],
            [
                0,
                ['name' => "Магазин \"Рассвет\""],
                []
            ]
        ];
    }
}
