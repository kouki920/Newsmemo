<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Contact\ConfirmRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactConfirmRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 投稿機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataContactConfirm
     *
     */
    public function testArticleStore(array $keys, array $values, bool $expect)
    {
        $dataList = array_combine($keys, $values);

        $rules = (new ConfirmRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataContactConfirm()
    {
        return [
            'OK' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', 'test@gmail.com', '30', 'テスト'],
                true
            ],
            '性別未選択エラー' => [
                ['gender', 'email', 'age', 'content'],
                [null, 'test@gmail.com', '30', 'テスト'],
                false
            ],
            'メールアドレス未入力時エラー' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', null, '30', 'テスト'],
                false
            ],
            'メールアドレス形式以外を入力時エラー' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', 'test', '30', 'テスト'],
                false
            ],
            '年齢未入力時エラー' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', 'test@gmail.com', null, 'テスト'],
                false
            ],
            '本文未入力時エラー' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', 'test@gmail.com', '30', null],
                false
            ],
            '本文文字数エラー' => [
                ['gender', 'email', 'age', 'content'],
                ['男性', 'test@gmail.com', '30', str_repeat('a', 751)],
                false
            ],
        ];
    }
}
