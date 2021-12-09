@extends('app')

@section('title', 'お問い合わせフォーム')
@section('content')
<div class="sticky-top">
    @include('nav')
    @include('articles.tabs', ['hasNewsApi' => false, 'hasCovidNews' => false, 'hasArticles' => false,'hasMypage' => false])
</div>
<div class="container">
    <div class="card contact-form-body">
        <div class="card-body text-center">
            <div class="card-title contact-form-body__title font-md">-&ensp;お問い合わせフォーム&ensp;-</div>

            @include('error_list')

            <div class="card-text">
                <form method="POST" action="{{ route('contacts.confirm',['id' => Auth::id()]) }}">
                    @csrf
                    <div class="form-group contact-form-body__radio-button font-sm">
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

                    <div class="form-group font-sm contact-form-body__select-bar">
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
                    <div class="form-group contact-form-body__email-form">
                        <label class="form-label font-sm" for="email">-&ensp;メールアドレス&ensp;-</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" />
                    </div>

                    <!-- Content input -->
                    <div class="form-group contact-form-body__content-form">
                        <label class="form-label font-sm" for="contactForm">-&ensp;お問い合わせ内容&ensp;-</label>
                        <textarea class="form-control" id="contactForm" name="content" rows="4">{{old('content')}}</textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn contact-form-body__form-button font-sm">確認画面へ進む</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection