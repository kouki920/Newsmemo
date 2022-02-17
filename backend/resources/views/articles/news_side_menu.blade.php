<div class="select-box-body headline-news-side-menu-body">
    <form class="form-inline" method="post" action="{{route('news.custom_index')}}">
        @csrf
        <div class="form-group headline-news-country-menu font-sm">
            <p class="headline-news-side-menu-title font-sm">-&ensp;Country&ensp;-</p>
            <ul class="headline-news-country-list font-sm">
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="jp-option" name="country" value="jp"><label for="jp-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">Japan</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="us-option" name="country" value="us"><label for="us-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">America</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="fr-option" name="country" value="fr"><label for="fr-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">France</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="pt-option" name="country" value="pt"><label for="pt-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">Portugal</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="de-option" name="country" value="de"><label for="de-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">Germany</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="it-option" name="country" value="it"><label for="it-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">Italy</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-country-item"><input type="radio" class="headline-news-country-item__radio" id="ru-option" name="country" value="ru"><label for="ru-option" class="headline-news-country-item__label">
                        <div class="headline-news-country-item__text">Russia</div>
                    </label>
                    <div class="headline-news-country-item__check radio-button-checked"></div>
                </li>
            </ul>
        </div>
        <div class="form-group headline-news-category-menu font-sm">
            <p class="headline-news-side-menu-title font-sm">-&ensp;Category&ensp;-</p>
            <ul class="headline-news-category-list font-sm">
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="general-option" name="category" value="general"><label for="general-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">General</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="entertainment-option" name="category" value="entertainment"><label for="entertainment-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">Entertainment</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="business-option" name="category" value="business"><label for="business-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">Business</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="science-option" name="category" value="science"><label for="science-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">Science</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="sports-option" name="category" value="sports"><label for="sports-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">Sports</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
                <li class="headline-news-category-item"><input type="radio" class="headline-news-category-item__radio" id="technology-option" name="category" value="technology"><label for="technology-option" class="headline-news-category-item__label">
                        <div class="headline-news-category-item__text">Technology</div>
                    </label>
                    <div class="headline-news-category-item__check radio-button-checked"></div>
                </li>
            </ul>
            <div class="form-group news-update-button-body">
                <input class="news-update-button font-sm" type="submit" value="Update">
            </div>
        </div>
    </form>
</div>