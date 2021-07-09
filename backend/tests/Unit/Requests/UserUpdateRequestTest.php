<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー情報の更新機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataUserUpdate
     *
     */
    public function testUserUpdate(array $keys, array $values, bool $expect)
    {
        $dataList = array_combine($keys, $values);

        $rules = (new UpdateRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataUserUpdate()
    {
        return [
            'OK' => [
                ['name', 'email', 'introduction'],
                ['test', 'test@gmail.com', 'test'],
                true
            ],
            '名前未入力時エラー' => [
                ['name', 'email', 'introduction'],
                [null, 'test@gmail.com', 'test'],
                false
            ],
            'name文字数エラー' => [
                ['name', 'email', 'introduction'],
                [str_repeat('a', 256), 'test@gmail.com', 'test'],
                false
            ],
            'email未入力時エラー' => [
                ['name', 'email', 'introduction'],
                ['test', null, 'test'],
                false
            ],
            'introduction文字数エラー' => [
                ['name', 'email', 'introduction'],
                ['test', 'test@gmail.com', str_repeat('a', 256)],
                false
            ],
        ];
    }
}
