<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Collection\StoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionStoreRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * コレクション機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataCollectionStore
     *
     */
    public function testCollectionStore(array $keys, array $values, bool $expect)
    {

        $dataList = array_combine($keys, $values);

        $rules = (new StoreRequest())->rules();

        $result = Validator::make($dataList, $rules)->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataCollectionStore()
    {
        return [
            'OK' => [
                ['collections'],
                ['"test"'],
                true
            ],
            '未入力時エラー' => [
                ['collections'],
                [null],
                false
            ],
            '/使用時エラー' => [
                ['collections'],
                ['/'],
                false
            ],
            '半角スペース入力時のテスト' => [
                ['collections'],
                ['/ {2,}/'],
                false
            ],
            '全角スペース入力時のテスト' => [
                ['collections'],
                ['/ +/'],
                false
            ]
        ];
    }
}
