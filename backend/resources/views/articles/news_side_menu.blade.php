<div class="select-box-body headline-news-side-menu-body">
    <form class="form-inline" method="post" action="{{route('news.custom_index')}}">
        @csrf
        <div class="form-group headline-news-country-menu font-md">
            <p class="headline-news-side-menu-title">国名</p>
            <ul class="headline-news-country-list">
                <li class="headline-news-country-item"><input type="radio" id="jp-option" name="country" value="jp"><label for="jp-option">日本</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="en-option" name="country" value="en"><label for="en-option">アメリカ</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="zh-option" name="country" value="zh"><label for="zh-option">中国</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="fr-option" name="country" value="fr"><label for="fr-option">フランス</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="pt-option" name="country" value="pt"><label for="pt-option">ポルトガル</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="de-option" name="country" value="de"><label for="de-option">ドイツ</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="es-option" name="country" value="es"><label for="es-option">スペイン</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="it-option" name="country" value="it"><label for="it-option">イタリア</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" id="ru-option" name="country" value="ru"><label for="ru-option">ロシア</label>
                    <div class="check"></div>
                </li>
            </ul>
        </div>
        <div class="form-group headline-news-category-menu font-md">
            <p class="headline-news-side-menu-title">カテゴリー</p>
            <ul class="headline-news-category-list">
                <li class="headline-news-category-item"><input type="radio" id="general-option" name="category" value="general"><label for="general-option">一般</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="jp-option" name="category" value="entertainment"><label for="jp-option">エンタメ</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="business-option" name="category" value="business"><label for="business-option">ビジネス</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="health-option" name="category" value="health"><label for="health-option">健康</label>
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
                <li class="headline-news-category-item"><input type="radio" id="it-option" name="category" value="it"><label for="it-option">イタリア</label>
                    <div class="check"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" id="ru-option" name="category" value="ru"><label for="ru-option">ロシア</label>
                    <div class="check"></div>
                </li>
            </ul>
        </div>
        <div class="form-group news-update-button">
            <input class="news-update-button-body" type="submit" value="更新">
        </div>
    </form>
</div>