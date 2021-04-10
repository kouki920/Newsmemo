<form method="post" action="{{route('api.covid_custom_index')}}">
    @csrf
    語圏を選択
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
    <p><input type="submit" value="更新"></p>
</form>