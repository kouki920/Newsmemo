<div class="select-box-body covid-news-tabs-body">
    <form class="form-inline" method="post" action="{{route('news.covid_custom_index')}}">
        @csrf
        <div class="form-group select-box font-md">
            言語選択:
            <select name="language">
                <option disabled selected value>未選択</option>
                <option value="jp" selected>日本語</option>
                <option value="en">英語圏</option>
                <option value="zh">中国語圏</option>
                <option value="fr">フランス語圏</option>
                <option value="pt">ポルトガル語圏</option>
                <option value="de">ドイツ語圏</option>
                <option value="es">スペイン語圏</option>
                <option value="it">イタリア語圏</option>
                <option value="ru">ロシア語圏</option>
            </select>
        </div>
        <div class="form-group news-update-button font-md">
            <input class="news-update-button-body" type="submit" value="更新">
        </div>
    </form>
</div>