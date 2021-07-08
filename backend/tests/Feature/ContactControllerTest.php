<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Contact;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * お問い合わせ画面の表示テスト
     * ログイン時、ステータスコード200、viewファイル(contacts.form)が使用されているかのテスト
     */
    public function testAuthForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('contacts.form'));

        $response->assertStatus(200)->assertViewIs('contacts.form');
    }

    /**
     * お問い合わせ内容の確認画面のテスト
     * ログイン時、ステータスコード200、内容確認画面で入力内容が表示されているかのテスト
     */
    public function testAuthConfirm()
    {
        $user = factory(User::class)->create();

        $data = [
            'gender' => '男性',
            'email' => 'test@gmail.com',
            'age' => 20,
            'content' => 'test',
        ];

        $response = $this->actingAs($user)->post(route('contacts.confirm', $data));

        $response->assertStatus(200)->assertViewIs('contacts.confirm')
            ->assertSee('確認画面')
            ->assertSee('男性')
            ->assertSee('test@gmail.com')
            ->assertSee('20')
            ->assertSee('test');
    }

    /**
     * お問い合わせ内容の送信テスト
     * ログイン時、データがテーブルに保存されているかのテスト、登録後リダイレクトされるかテスト
     */
    public function testAuthSend()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $contact = factory(Contact::class)->create();

        $response = $this->actingAs($user)->from('contacts')->post(route(
            'contacts.send',
            [
                'gender' => $contact->gender,
                'email' => $contact->email,
                'age' => $contact->age,
                'content' => $contact->content,
            ]
        ));

        $this->assertDatabaseHas('contacts', [
            'gender' => $contact->gender,
            'email' => $contact->email,
            'age' => $contact->age,
            'content' => $contact->content,
        ]);

        $response->assertStatus(302);
    }
}
