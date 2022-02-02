<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Memo\StoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoStoreRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メモ機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataMemoStore
     *
     */
    public function testMemoStore(array $keys, array $values, bool $expect)
    {
        $dataList = array_combine($keys, $values);

        $rules = (new StoreRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataMemoStore()
    {
        return [
            'OK' => [
                ['user_id', 'body'],
                ['1', 'test'],
                true
            ],
            '文字数エラー' => [
                ['user_id', 'body'],
                ['1', str_repeat('a', 256)],
                false
            ],
            '未入力エラー' => [
                ['user_id', 'body'],
                ['1', null],
                false
            ]
        ];
    }
}
