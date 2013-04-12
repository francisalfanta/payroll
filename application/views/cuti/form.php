<?php get_header(); ?>
<?php echo load_js(array(
  "plugins/ckeditor/ckeditor.js"
));?>
<script type="text/javascript">
    $(document).ready(function(){
      $("#staff").autocomplete({
        source: function(request, response){
          console.log(request)
          var url = "<?php echo site_url('absensi/get_staff')?>/"+request.term;
          $.getJSON(url, function(data){
            var list = [];
            $.each(data, function(i, v){
              var li = {
                value: v.staff_name,
                staff_id: v.staff_id
              }
              list.push(li);
            });
            response(list);
          });
        },
        select: function(event, ui){
          $("#staff_id").val(ui.item.staff_id);
        }
      });
    });
</script>
<div class="body">
    <div class="content">
        <h2 class="rama-title">Form Izin</h2>
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id; ?>" />
        <table width="100%">
          <tr>
              <td width="20%">Staff</td>
              <td><div class="span3"><?php echo form_input($staff_name); ?></div></td>
          </tr>
          <tr>
              <td width="20%">Approve by</td>
              <td><div class="span3"><?php echo form_input($staff_name); ?></div></td>
          </tr>
          <tr>
              <td>Tanggal pengajuan</td>
              <td><div class="span2"><?php echo form_input($date_request); ?></div></td>
          </tr>
          <tr>
            <td>Mulai cuti</td>
            <td><div class="span2"><?php echo form_input($date_start); ?></div></td>
          </tr>
          <tr>
            <td>Akhir cuti</td>
            <td><div class="span2"><?php echo form_input($date_end); ?></div></td>
          </tr>
          <tr>
            <td>Status</td>
            <td><div class="span1"><?php echo form_dropdown("status", $status); ?></div></td>
          </tr>
        </table>
        <input type="submit" name="save" class="btn btn-primary" />
        <a href="<?php echo site_url('izin/index'); ?>" class="btn btn-danger">Back</a>
        <?php echo form_close() ?>
    </div>
</div>
<script type="text/javascript">
  CKEDITOR.replace("izin_note");
</script>
<?php get_footer(); ?>
