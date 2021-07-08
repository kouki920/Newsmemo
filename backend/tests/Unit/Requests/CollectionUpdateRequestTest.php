<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Collection\UpdateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * コレクション機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataCollectionUpdate
     *
     */
    public function testCollectionUpdate(array $keys, array $values, bool $expect)
    {

        $dataList = array_combine($keys, $values);

        $rules = (new UpdateRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataCollectionUpdate()
    {
        return [
            'OK' => [
                ['name'],
                ['テスト'],
                true
            ],
            '未入力時エラー' => [
                ['name'],
                [null],
                false
            ],
            '文字数エラー' => [
                ['name'],
                [str_repeat('a', 256)],
                false
            ],
            'スラッシュ入力時エラー' => [
                ['name'],
                ['/'],
                false
            ]
        ];
    }
}
