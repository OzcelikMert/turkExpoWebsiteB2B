<?php 
include("./pages/event/functions/get_event_categories.php");
include("./pages/event/functions/create_event.php");
?>
<div class="row">
    <div class="alert alert-warning col-md-12" role="alert" id="notes">
        <h4><?php echo _notes; ?></h4>
        <ul>
            <li><?php echo _events_desc_1; ?></li>
            <!--li><?php // echo _events_desc_2; ?></li-->
            <li><b><?php echo _events_desc_3; ?><b></li>
        </ul>
    </div>
</div>
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-email"><?php echo _new_events; ?></h4>
      <h5 class="text-center" style="color: red;"><?php echo $dateError; ?></h5>
      <form class="forms-sample" method="post" enctype="multipart/form-data">
        <!--div class="form-group">
          <label for="category"><?php //echo _select_category; ?></label>
          <div class="input-group-selectbox">
          <select name="category" class="form-control" required>
              <?php //echo $EventCategories_Value; ?>
          </select>
          </div>
        </div-->
        <div class="form-group">
          <label for="title"><?php echo _title; ?> (TR,EN,FR)</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="<?php echo _title; ?> (TÜRKÇE)" maxlength="65" value="<?php if(!empty($_POST["title"])){ echo $_POST["title"];}?>" required>
          <input type="text" name="title_en" id="title" class="form-control" placeholder="<?php echo _title;?> (ENGLISH)" maxlength="65" value="<?php if(!empty($_POST["title"])){ echo $_POST["title"];}?>" >
          <input type="text" name="title_fr" id="title" class="form-control" placeholder="<?php echo _title; ?> (FRANÇAIS)" maxlength="65" value="<?php if(!empty($_POST["title"])){ echo $_POST["title"];}?>" >

        </div>
        <div class="form-group">
          <label for="comment"><?php echo _comment; ?> (TR,EN,FR)</label>
          <div class="input-group">
            <textarea class="form-control" id="comment" name="comment" rows="10" maxlength="600"  required placeholder="<?php echo _comment;?> (TÜRKÇE)"><?php if(!empty($_POST["comment"])){ echo $_POST["comment"];} ?></textarea>
            <textarea class="form-control" id="comment" name="comment_en" rows="10" maxlength="600" placeholder="<?php echo _comment;?> (ENGLISH)"><?php if(!empty($_POST["comment"])){ echo $_POST["comment"];} ?></textarea>
            <textarea class="form-control" id="comment" name="comment_fr" rows="10" maxlength="600" placeholder="<?php echo _comment;?>  (FRANÇAIS)" ><?php if(!empty($_POST["comment"])){ echo $_POST["comment"];} ?></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-success mr-2"><?php echo _share_event; ?></button>
      </form>
    </div>
  </div>
</div>
</div>
<div class="row">
        <?php echo $ErrorMessage_show; ?>
</div>
