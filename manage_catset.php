<div class="container-fluid">
    <div class="col-lg-12">
        <form action="" id="manage-settings">
            <input type="hidden" name="voting_id" value="<?php echo $_GET['vid'] ?>">
            <input type="hidden" name="category_id" value="<?php echo $_GET['cid'] ?>">
            <input type="hidden" name="user_id" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
                <label for="" class="control-label">Maximum number of Selection</label>
                <input type="number" class="form-control" name="max_selection" value="<?php echo $_GET['max'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>

            <?php if (isset($_GET['id'])): ?>
                <button type="button" class="btn btn-danger" id="delete_settings">Delete Settings</button>
            <?php endif; ?>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#manage-settings').submit(function (e) {
            e.preventDefault();
            start_load();
            $.ajax({
                url: 'ajax.php?action=save_settings',
                method: 'POST',
                data: $(this).serialize(),
                error: function (err) {
                    console.log(err);
                },
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast('Data successfully updated.', 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        });

        $('#delete_settings').click(function () {
            var userId = $('input[name="user_id"]').val();
            var confirmDelete = confirm('Are you sure you want to delete these settings?');

            if (confirmDelete) {
                $.ajax({
                    url: 'ajax.php?action=delete_settings',
                    method: 'POST',
                    data: { user_id: userId },
                    success: function (resp) {
                        if (resp == 1) {
                            alert_toast('Settings deleted successfully.', 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        alert_toast('Error deleting settings. Please try again.', 'error');
                    }
                });
            }
        });
    });
</script>
