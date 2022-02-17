<div class="select-box-body">
    <form class="form-inline" method="post" action="{{route('news.covid_custom_index')}}">
        @csrf
        <div class="form-group select-box font-md">
            言語選択:
            <select name="language">
                <option value="jp" selected>日本語</option>
                <option value="en">英語</option>
                <option value="zh">中国語</option>
                <option value="fr">フランス語</option>
                <option value="pt">ポルトガル語</option>
                <option value="de">ドイツ語</option>
                <option value="es">スペイン語</option>
                <option value="it">イタリア語</option>
                <option value="ru">ロシア語</option>
            </select>
        </div>
        <div class="form-group news-update-button-body">
            <input class="news-update-button-body__update-button font-sm" type="submit" value="更新">
        </div>
    </form>
</div>