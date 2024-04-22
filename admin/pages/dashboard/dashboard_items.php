<?php include_once("./pages/dashboard/functions/get_values.php"); ?>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0"><?php echo _message_statistics; ?>  </h4>
      </div>
      <div class="card-body">
        <div class="d-flex flex-column flex-lg-row">
          <ul class="nav nav-tabs sales-mini-tabs ml-lg-auto mb-4 mb-md-0" role="tablist" style="align-self: center;">
            <li class="nav-item">
              <a class="nav-link active" style="cursor: pointer;" id="messages-statistics_switch_1" data-toggle="tab" role="tab" aria-selected="true">1 <?php echo _week; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="cursor: pointer;" id="messages-statistics_switch_2" data-toggle="tab" role="tab" aria-selected="false">1 <?php echo _month; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="cursor: pointer;" id="messages-statistics_switch_3" data-toggle="tab" role="tab" aria-selected="false">1 <?php echo _year; ?></a>
            </li>
          </ul>
        </div>
        <div class="d-flex flex-column flex-lg-row" style="align-items: center;">
          <div class="data-wrapper d-flex mt-2 mt-lg-0">
            <div class="wrapper">
              <h5 class="mb-0"><?php echo _total_message; ?></h5>
              <div class="d-flex align-items-center">
                <h4 class="font-weight-semibold mb-0"><?php echo $TotalMessage; ?></h4>
              </div>
            </div>
          </div>
          <div class="ml-lg-auto" id="messages-statistics-legend"></div>
        </div>
        <canvas class="mt-5" height="120" id="messages-statistics-overview"></canvas>
      </div>
    </div>
  </div>
  <?php  if($c_type==1){ echo '
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">'._view_statistics.'</h4>
      </div>
      <div class="card-body">
        <div class="d-flex flex-column flex-lg-row">
          <ul class="nav nav-tabs sales-mini-tabs ml-lg-auto mb-4 mb-md-0" role="tablist" style="align-self: center;">
            <li class="nav-item">
              <a class="nav-link active" style="cursor: pointer;" id="views-statistics_switch_1" data-toggle="tab" role="tab" aria-selected="true">1 '._week.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="cursor: pointer;" id="views-statistics_switch_2" data-toggle="tab" role="tab" aria-selected="false">1 '._month.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="cursor: pointer;" id="views-statistics_switch_3" data-toggle="tab" role="tab" aria-selected="false">1 '. _year.'</a>
            </li>
          </ul>
        </div>
        <div class="d-flex flex-column flex-lg-row" style="align-items: center;">
          <div class="data-wrapper d-flex mt-2 mt-lg-0">
            <div class="wrapper">
              <h5 class="mb-0"><?php echo _total_view;?></h5>
              <div class="d-flex align-items-center">
                <h4 class="font-weight-semibold mb-0">'. $TotalView .'</h4>
              </div>
            </div>
          </div>
          <div class="ml-lg-auto" id="views-statistics-legend"></div>
        </div>
        <canvas id="barChart" class="mt-5" height="120"></canvas>
      </div>
    </div>
  </div>';} ?>
</div> 
<div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4 class="card-title mb-0 text-center" style="width: 100%;"><?php echo _latest_exports; ?></h4>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th><?php echo _country; ?></th>
                    <th><?php echo _total_price; ?></th>
                    <th><?php echo _date; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $Exports; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-0 text-center"><?php echo _recent_events; ?></h4>
        <?php echo $Events; ?>
        <a class="d-block mt-5 text-center" href="../index.php#events_" target="_blank"><?php echo _show_all; ?></a>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between pb-3">
          <h4 class="card-title mb-0 text-center" style="width: 100%;"><?php echo _recent_registereds; ?></h4>
        </div>
        <ul class="timeline">
          <?php echo $Registereds; ?>
        </ul>
      </div>
    </div>
  </div>
</div>