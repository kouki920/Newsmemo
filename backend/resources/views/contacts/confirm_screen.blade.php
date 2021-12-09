<div class="card confirm-body">
    <div class="card-body confirm-body__content">
        <div class="card-title confirm-body__content-title font-md">-&ensp;確認画面&ensp;-</div>

        @include('error_list')

        <div class="card-text confirm-body__content-list">
            <form method="POST" action="{{ route('contacts.send',['id' => Auth::id()]) }}">
                @csrf

                <div class="form-group font-sm confirm-body__content-item">
                    <p>・性別<span class="confirm-content-text">必須</span></p>

                    {{ $inputs['gender'] }}

                    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                </div>

                <div class="form-group font-sm confirm-body__content-item">
                    <p>・メールアドレス<span class="confirm-body__content-text">必須</span></p>

                    {{ $inputs['email'] }}

                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>

                <div class="form-group font-sm confirm-body__content-item">
                    <p>・年齢<span class="confirm-body__content-text">必須</span></p>

                    {{ $inputs['age'] }}代

                    <input type="hidden" name="age" value="{{ $inputs['age'] }}">
                </div>

                <div class="form-group font-sm confirm-body__content-item">
                    <p>・お問い合わせ内容<span class="confirm-body__content-text">必須</span></p>

                    {{ $inputs['content'] }}

                    <input type="hidden" name="content" value="{{ $inputs['content'] }}">
                </div>

                <div class="confirm-body__button-list">
                    <button name="action" type="submit" value="back" class="btn confirm-body__cancel-button font-sm">入力画面に戻る</button>
                    <button name="action" type="submit" value="submit" class="btn confirm-body__submit-button font-sm">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>