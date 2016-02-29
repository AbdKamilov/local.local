<form role="form" method="post" action="{!! $action !!}">
    <div class="form-group">
        <label for="text">Аты:</label>
        <input type="text" class="form-control" name="f_name">
        <input name="_token" hidden value="{!! csrf_token() !!}" />
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="f_email">
    </div>
    <div class="form-group">
        <label for="comment">Кат:</label>
        <textarea class="form-control" rows="5" name="f_message"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Жиберуу:</button>
</form>