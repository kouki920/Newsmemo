<table class="table table-bordered user-data-body">
    <thead>
        <tr class="table-active user-data-header">
            <th scope="col"><i class="fas fa-sticky-note fa-fw"></i>メモ数</th>
            <th scope="col"><i class="far fa-chart-bar fa-fw"></i>累計投稿日数</th>
            <th scope="col"><i class="far fa-clock fa-fw"></i>最終ログイン</th>
        </tr>
    </thead>
    <tbody>
        <tr class="user-data-contents">
            <td>{{$articles_count}}</td>
            <td>{{$days_posted}}</td>
            <td>{{$last_login}}</td>
        </tr>
    </tbody>
</table>