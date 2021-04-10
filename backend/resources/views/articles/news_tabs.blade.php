<form method="post" action="{{route('api.custom_index')}}">
    @csrf
    国名:
    <select name="country">
        <option disabled selected value>未選択</option>
        <option value="jp" selected>日本</option>
        <option value="fr">フランス</option>
        <option value="ca">カナダ</option>
        <option value="de">ドイツ</option>
        <option value="gb">イギリス</option>
        <option value="it">イタリア</option>
        <option value="us">アメリカ</option>
        <option value="ru">ロシア</option>
    </select>
    カテゴリー:
    <select name="category">
        <option disabled selected value>未選択</option>
        <option value="entertainment">entertainment</option>
        <option value="business">business</option>
        <option value="general">general</option>
        <option value="health">health</option>
        <option value="science">science</option>
        <option value="sports">sports</option>
        <option value="technology">technology</option>
    </select>

    <p><input type="submit" value="更新"></p>
</form>