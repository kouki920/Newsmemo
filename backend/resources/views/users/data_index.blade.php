<table class="table table-bordered mt-4">
    <thead>
        <tr class="table-active text-center">
            <th scope="col"><i class="fas fa-sticky-note fa-fw"></i>メモ数</th>
            <th scope="col"><i class="far fa-chart-bar fa-fw"></i>累計投稿日数</th>
            <th scope="col"><i class="far fa-clock fa-fw"></i>最終ログイン</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td>{{$articles_count}}個</td>
            <td>{{$days_posted}}日</td>
            <td>{{$last_login}}</td>
        </tr>
    </tbody>
</table>