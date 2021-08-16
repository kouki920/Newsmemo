<div class="select-box-body covid-news-side-menu-body">
    <form class="form-inline" method="post" action="{{route('news.covid_custom_index')}}">
        @csrf
        <div class="form-group covid-news-language-menu font-md">
            <p class="covid-news-side-menu-title">言語選択</p>
            <ul class="covid-news-language-list">
                <li class="covid-news-language-item"><input type="radio" id="jp-option" name="language" value="jp"><label for="jp-option">日本語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="f-option" name="language" value="en"><label for="f-option">英語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="zh-option" name="language" value="zh"><label for="zh-option">中国語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="fr-option" name="language" value="fr"><label for="fr-option">フランス語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="pt-option" name="language" value="pt"><label for="pt-option">ポルトガル語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="de-option" name="language" value="de"><label for="de-option">ドイツ語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="es-option" name="language" value="es"><label for="es-option">スペイン語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="it-option" name="language" value="it"><label for="it-option">イタリア語</label>
                    <div class="check"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" id="ru-option" name="language" value="ru"><label for="ru-option">ロシア語</label>
                    <div class="check"></div>
                </li>
            </ul>
            <div class="form-group news-update-button">
                <input class="news-update-button-body" type="submit" value="更新">
            </div>
        </div>

    </form>
</div>