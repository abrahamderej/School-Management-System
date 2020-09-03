  <!-- <p class="footer" style="margin-top: 80px">copy right @2020</p>-->
    </div>
<script>
    $(document).on('click', '.delete-object', function () {

        var staff_id = $(this).attr('delete-id');
        bootbox.confirm({
            message: "<h4> Are you sure? </h4>",
            buttons:{
                confirm:{
                    label:'<span class="fa fa-check-circle"></span> YES',
                    className:'btn-danger'
                },
                cancel:{
                    label:'<span class="fa fa-trash"></span> NO',
                    className:'btn-primary'
                }
            },
            callback: function (result) {
                if(result==true){
                    $.post('delete_staff.php',{
                        object_id: staff_id
                    }, function (data) {
                        location.reload();
                    }).fail(function () {
                        alert('unable to delete');
            });
                }
            }
        });
        return false;
    });
</script>
    <script type="text/javascript" src="common/js/jquery-v3.3.1.min.js"></script>
    <script type="text/javascript" src="common/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="common/js/bootbox.min.js"></script>
  <!--  bootbox library-->

</body>
</html>