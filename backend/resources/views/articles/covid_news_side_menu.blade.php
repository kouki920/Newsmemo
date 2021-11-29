<div class="select-box-body covid-news-side-menu-body">
    <form class="form-inline" method="post" action="{{route('news.covid_custom_index')}}">
        @csrf
        <div class="form-group covid-news-language-menu font-sm">
            <p class="covid-news-side-menu-title">Country</p>
            <ul class="covid-news-language-list font-sm">
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="jp-option" name="language" value="jp"><label for="jp-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Japan</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="en-option" name="language" value="en"><label for="en-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">America</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="zh-option" name="language" value="zh"><label for="zh-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">China</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="fr-option" name="language" value="fr"><label for="fr-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">France</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="pt-option" name="language" value="pt"><label for="pt-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Portugal</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="de-option" name="language" value="de"><label for="de-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Germany</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="es-option" name="language" value="es"><label for="es-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Spain</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="it-option" name="language" value="it"><label for="it-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Italy</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
                <li class="covid-news-language-item"><input type="radio" class="covid-news-language-item__radio" id="ru-option" name="language" value="ru"><label for="ru-option" class="covid-news-language-item__label">
                        <div class="covid-news-language-item__text">Russia</div>
                    </label>
                    <div class="covid-news-language-item__check radio-button-checked"></div>
                </li>
            </ul>
            <div class="form-group news-update-button-body">
                <input class="news-update-button font-sm" type="submit" value="Update">
            </div>
        </div>

    </form>
</div>