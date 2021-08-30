<div class="card confirm-body">
    <div class="card-body confirm-body-content">
        <div class="card-title confirm-title font-md">-確認画面-</div>

        @include('error_list')

        <div class="card-text confirm-content-list">
            <form method="POST" action="{{ route('contacts.send',['id' => Auth::id()]) }}">
                @csrf

                <div class="form-group font-sm confirm-content-item">
                    <p>・性別<span class="confirm-content-required">必須</span></p>

                    {{ $inputs['gender'] }}

                    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                </div>

                <div class="form-group font-sm confirm-content-item">
                    <p>・メールアドレス<span class="confirm-content-required">必須</span></p>

                    {{ $inputs['email'] }}

                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>

                <div class="form-group font-sm confirm-content-item">
                    <p>・年齢<span class="confirm-content-required">必須</span></p>

                    {{ $inputs['age'] }}代

                    <input type="hidden" name="age" value="{{ $inputs['age'] }}">
                </div>

                <div class="form-group font-sm confirm-content-item">
                    <p>・お問い合わせ内容<span class="confirm-content-required">必須</span></p>

                    {{ $inputs['content'] }}

                    <input type="hidden" name="content" value="{{ $inputs['content'] }}">
                </div>

                <div class="confirm-button">
                    <button name="action" type="submit" value="back" class="btn confirm-cancel-button">入力画面に戻る</button>
                    <button name="action" type="submit" value="submit" class="btn confirm-submit-button">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>