<div class="pt100">
        <a id ="search-sidebar" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <div class="w30 h100">
          <div class="search-tools">
          <a id ="search-sidebar-c"  href="javascript:void(0);">X</a>

              <!--div class="search-tools-box">
                <h4><?php //echo _country; ?></h4>
                <div class="search-tools-links">
                    <?php //echo $Country_Values; ?>
                </div>
              </div-->

            <div class="search-tools-box search-b-space">
                <h4><?php echo _main_category; ?> </h4>
                <div class="search-tools-links">
                  <?php echo $MainCategory_Values; ?>
                </div>
              </div>
              
            <div class="search-tools-box search-b-space">
                <h4><?php echo _sub_category; ?></h4>
                <div class="search-tools-links">
                  <?php echo $SubCategory_Values; ?>
                </div>
              </div>
          </div>
          <div class="Wanted-Text">
            <span>
              <?php echo $searchValues; ?>
            </span>
          </div>
        </div>
        <div class="w70 h100">
        <?php echo $Business_Values; ?>
        </div>
    </div>
</div>
    <div class="search-pages">
      <?php echo $PageCount_Buttons; ?>
    </div>
