<div class="card mt-3">
    <div class="card-body text-center">
        <h2 class="h3 card-title text-center mt-2">確認画面</h2>

        @include('error_list')

        <div class="card-text mt-3">
            <form method="POST" action="{{ route('contacts.send') }}">
                @csrf

                <div class="form-group row">
                    <p class="col-sm-4 col-form-label">性別<span class="badge badge-danger ml-1">必須</span></p>
                    <div class="col-sm-8">
                        {{ $inputs['gender'] }}
                    </div>
                    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                </div>

                <div class="form-group row">
                    <p class="col-sm-4 col-form-label">メールアドレス<span class="badge badge-danger ml-1">必須</span></p>
                    <div class="col-sm-8">
                        {{ $inputs['email'] }}
                    </div>
                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>

                <div class="form-group row">
                    <p class="col-sm-4 col-form-label">年齢<span class="badge badge-danger ml-1">必須</span></p>
                    <div class="col-sm-8">
                        {{ $inputs['age'] }}
                    </div>
                    <input type="hidden" name="age" value="{{ $inputs['age'] }}">
                </div>

                <div class="form-group row">
                    <p class="col-sm-4 col-form-label">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></p>
                    <div class="col-sm-8">
                        {{ $inputs['content'] }}
                    </div>
                    <input type="hidden" name="content" value="{{ $inputs['content'] }}">
                </div>

                <div class="text-center">
                    <button name="action" type="submit" value="back" class="btn btn-dark">入力画面に戻る</button>
                    <button name="action" type="submit" value="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>