    <div class="select-box-body">
        <form class="form-inline" method="post" action="{{route('news.custom_index')}}">
            @csrf
            <div class="form-group select-box">
                <!-- 国名: -->
                <select name="country">
                    <option disabled selected value>国名</option>
                    <option value="jp">日本</option>
                    <option value="fr">フランス</option>
                    <option value="ca">カナダ</option>
                    <option value="de">ドイツ</option>
                    <option value="gb">イギリス</option>
                    <option value="it">イタリア</option>
                    <option value="us">アメリカ</option>
                    <option value="ru">ロシア</option>
                </select>
            </div>
            <div class="form-group select-box">
                <!-- カテゴリー: -->
                <select name="category">
                    <option disabled selected value>カテゴリー</option>
                    <option value="entertainment">芸能</option>
                    <option value="business">ビジネス</option>
                    <option value="general">一般</option>
                    <option value="health">健康</option>
                    <option value="science">サイエンス</option>
                    <option value="sports">スポーツ</option>
                    <option value="technology">テクノロジー</option>
                </select>
            </div>
            <div class="form-group update-button">
                <input id="update-button" type="submit" value="更新">
            </div>
        </form>
    </div>