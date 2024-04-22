<?php // include("./pages/products/functions/add-product.php"); ?>

<div class="row">

<!-- Company export -->

<?php require_once("./pages/exports/functions/edit_export.php"); ?> 
<?php require_once("./pages/exports/functions/delete_export.php"); ?> 
<?php require_once("./pages/exports/functions/get.php"); ?> 

<div class="col-lg-12" id="col-3">
    <div class="card">
        <div class="card-body">
        <div class="table-responsive">
            <h4 class="card-title"><?php echo _latest_exports; ?></h4>
            <div class="row">
                <?php echo $ErrorMessage_show_2; ?>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><?php echo _country_export; ?></th>
                        <th><?php echo _total_price; ?></th>
                        <th><?php echo _date; ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <!----------->

                    <tr>
                    <form action="" id="profile" method="post">
                        <td>
                            <select name="coe_country" class="form-control" required>
                                <?php echo $Countrys; ?>
                            </select>
                        </td>

                        <td><div class="input-group"><div id="responsive-btn-t" class="input-group-prepend bg-primary border-primary tel-select-div"  style="margin-top: -3px;margin-left: -15px;">
                            <select name="money_type" id="responsive-btn"  class="form-control input-group-text bg-transparent" required="">
                                <option value="$">$</option><option value="€">€</option><option value="₺">₺</option><option value="₽">₽</option></select></div>
                            <input id="c-of-ex" name="coe_price" type="number" class="form-control" required=""></div></td>
                        <td><input id="c-of-ex" name="coe_date" type="number" min="1980" max="<?php echo date("Y");?>" placeholder="YIL" required="" maxlength="70" class="form-control"></td>
                        <td>
                            <input type="hidden" name="form_value" value="export">
                            <input id="c-of-ex" type="submit" class="form-control" style="background: #19d895;color: white;font-size: 14px;" value="<?php echo _add;?>">
                        </td>
                        </form>
                    </tr>
                    <!----------->
                    <?php 
                    echo $Exports; 
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
