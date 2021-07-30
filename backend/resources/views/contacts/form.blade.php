@extends('app')

@section('title', 'お問い合わせフォーム')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="card mt-3">
        <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">お問い合わせフォーム</h2>

            @include('error_list')

            <div class="card-text">
                <form method="POST" action="{{ route('contacts.confirm',['id' => Auth::id()]) }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="form-label">性別</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="男性" />
                            <label class="form-check-label" for="male">男性</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="女性" />
                            <label class="form-check-label" for="female">女性</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="not" value="無回答" />
                            <label class="form-check-label" for="not">回答しない</label>
                        </div>
                    </div>

                    <div class="form-group  mb-4">
                        <label class="visually-hidden">年齢</label>
                        <select class="select" name="age">
                            <option hidden>選択してください</option>
                            <option value="10">10代</option>
                            <option value="20">20代</option>
                            <option value="30">30代</option>
                            <option value="40">40代</option>
                            <option value="50">50代</option>
                            <option value="60">60代</option>
                            <option value="70">70代</option>
                            <option value="80">80代</option>
                            <option value="90">90代</option>
                        </select>
                    </div>


                    <!-- Email input -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" />
                    </div>

                    <!-- Content input -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="contactForm">お問い合わせ内容</label>
                        <textarea class="form-control" id="contactForm" name="content" rows="4">{{old('content')}}</textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">確認画面へ進む</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection