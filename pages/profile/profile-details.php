 <div class="profile-about-desc">
                   <p><?php echo $Company_Values["about"]; ?></p>
                   <div class="profile-website">
               <h4><i class="fa fa-link"></i> <?php echo _bussines_web_site; ?> : <a style="font-size: 14px;"; href="<?php echo $Company_Values["website"];?>"><?php echo $Company_Values["website"];?></a></h4>
               </div>
               </div>
               <div class="profile-info">     
                   <div class="profile-info-products">
                       <h3 style="font-size: 18px;"><?echo _products; ?></h3>
                       <br>
                           <?php 
                             echo $Product_Values;
                             echo $Event_Values;

                           ?>
                   </div>     
                   <div class="profile-info-left">
                       <h3 style="font-size: 18px;"><?php echo _numerical_data;?></h3>
                       <br>
                       <h4><i class="fa fa-user"> </i> <?php echo _number_employees; echo " : <b>".$Company_Values["employees_count"];?> </b></h4>
                   </div>     
                   <div class="profile-info-right">
                        <h3 style="font-size: 18px;"><?php echo _keywords_company;?></h3>
                       <br>
                       <p>
                         <?php  $activitys = explode(",",$Company_Values["activity"]); foreach ($activitys as $value) {echo '<span>',$value,'</span>';}?>
                       </p>
                   </div> 
                     </div>     
           <div class="profile-exports">
             <br>
         <h5><?php echo _latest_exports; ?></h5>
           <table>
             <tr id="table-header">
               <th><?php echo _country_export;?></th>
               <th><?php echo _total_price;?></th>
               <th><?php echo _year;?></th>     
             </tr>
             <?php echo $Export_Values; ?>
           </table>
         <br> 
      </div>
  </div>
</div 