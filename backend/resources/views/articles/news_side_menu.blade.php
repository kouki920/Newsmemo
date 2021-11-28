<div class="select-box-body headline-news-side-menu-body">
    <form class="form-inline" method="post" action="{{route('news.custom_index')}}">
        @csrf
        <div class="form-group headline-news-country-menu font-sm">
            <p class="headline-news-side-menu-title font-sm">国名</p>
            <ul class="headline-news-country-list font-sm">
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="jp-option" name="country" value="jp"><label for="jp-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">日本</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="us-option" name="country" value="us"><label for="us-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">アメリカ</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="fr-option" name="country" value="fr"><label for="fr-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">フランス</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="pt-option" name="country" value="pt"><label for="pt-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">ポルトガル</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="de-option" name="country" value="de"><label for="de-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">ドイツ</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="it-option" name="country" value="it"><label for="it-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">イタリア</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="ru-option" name="country" value="ru"><label for="ru-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">ロシア</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
            </ul>
        </div>
        <div class="form-group headline-news-category-menu font-sm">
            <p class="headline-news-side-menu-title font-sm">カテゴリー</p>
            <ul class="headline-news-category-list font-sm">
                <li class="headline-news-category-item"><input type="radio" id="general-option" name="category" value="general"><label for="general-option">一般</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="entertainment-option" name="category" value="entertainment"><label for="entertainment-option">エンタメ</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="business-option" name="category" value="business"><label for="business-option">ビジネス</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="science-option" name="category" value="science"><label for="science-option">サイエンス</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="sports-option" name="category" value="sports"><label for="sports-option">スポーツ</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="technology-option" name="category" value="technology"><label for="technology-option">テクノロジー</label>
                    <div class="check"></div>
                </li>
            </ul>
            <div class="form-group news-update-button-body">
                <input class="news-update-button font-sm" type="submit" value="更新">
            </div>
        </div>
    </form>
</div>