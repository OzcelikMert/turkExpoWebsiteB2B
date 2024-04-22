<div class="row">
    <div class="alert alert-success col-md-12" role="alert" id="notes">
        <h4><?php echo _notes; ?></h4>
        <ul>
            <li><?php echo _note_activty_1; ?></li>
            <li><?php echo _note_activty_2; ?></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"></h4>
            <p class="card-description" style="text-align: center;"><?php echo _company_keywords; ?></p>
            <form class="forms-sample" method="post">
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"><?php echo _main_category; ?></label>
                <div class="col-sm-2 input-group-selectbox">
                <select id="activity_main_category" name="main_category" class="form-control" required>
                    <?php echo $get_category; ?>
                </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"><?php echo _sub_category; ?></label>
                <div class="col-sm-2 input-group-selectbox">
                <select id="activity_sub_category"  name="sub_category" class="form-control" required>
                  <option value='0'>...</option>
                </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"><?php echo _tags; ?></label>
                <div class="col-sm-9 input-group">
                  <textarea style="    font-size: 15px;" id="activity" class="form-control" name="activity" row="5" maxlength="200" placeholder="<?php echo _ph_activty_des ?>" onkeyup="activitys_length()" required><?php echo $get_activity; ?></textarea>
                  <div id="length_text" style="position: absolute;right: 20px;top: 5px;font-size: x-small;z-index: 99;">0/200</div>
                </div>
              </div>
              <button type="submit" class="btn btn-success mr-2" style="float: right;padding: 15px;"><?php echo _confirm; ?></button>
            </form>
          </div>
        </div>
    </div>
</div>

<script>
function activitys_length(){
var textarea_length = $("#activity").val().length;
$("#length_text").html(""+textarea_length+"/200");
}
</script>