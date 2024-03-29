<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Memo\UpdateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メモ機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataMemoUpdate
     *
     */
    public function testMemoUpdate(array $keys, array $values, bool $expect)
    {
        $dataList = array_combine($keys, $values);

        $rules = (new UpdateRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataMemoUpdate()
    {
        return [
            'OK' => [
                ['body'],
                ['test'],
                true
            ],
            '文字数エラー' => [
                ['body'],
                [str_repeat('a', 256)],
                false
            ],
            '未入力エラー' => [
                ['body'],
                [null],
                false
            ]
        ];
    }
}
