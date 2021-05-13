<!-- フラッシュメッセージ -->

<!-- 成功時 -->
@if(Session::has('msg_success'))
<script>
    $(function() {
        toastr.success("{{ Session::get('msg_success') }}");
    });
</script>
<!-- 失敗時 -->
@elseif(Session::has('msg_error'))
<script>
    $(function() {
        toastr.error("{{ Session::get('msg_error') }}");
    });
</script>
@endif