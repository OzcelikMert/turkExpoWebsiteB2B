<!DOCTYPE html>

<html lang="tr">

<head>

<title>TurkExpo</title>

<?php 
include("./tools/metas.php");
include("./tools/links.php");
include("./tools/includes.php");
$langdata = lang_check($lang);
?>

<link rel="stylesheet" href="z_tools/swiper.min.css"> <!---SLIDER---->
</head>
<body>
<?php
    include("./sameparts/preloader.php");
   include("./pages/profile/functions/get_values.php");
?>

    <div class="super_container" style="background: #efefef;">
        <?php
            include("./sameparts/header.php");
            include("./sameparts/menu.php");
        ?>

 <div class="container">
  <div class="row">
      <div class="profile col-md-8 no-padding">
          <div class="profile-top-image full-img">
              <img src="./images/banner_images/<?php echo $Company_Values["banner"]; ?>" alt="">
          </div>

          <div class="profile-user-image">
              <img src="/images/company_logo/<?php echo $Company_Values["logo"]; ?>" alt="">
          </div>

          <div class="profile-about">
              <div class="profile-about-left">
                  <h3><?php echo $Company_Values["name"];?></h3>
                  <!--h4><?php// echo $Company_Values["slogan"];?></h4-->
              </div>

              <div class="profile-about-right">
                  <!--h4><i class="fa fa-flag"></i> <?php // echo $Company_Values["ProfileCountry"];?></h4-->
                  <h4 style="text-align: right;"><i class="fa fa-eye"></i> <?php echo $Company_Values["view"];?></h4>
              </div>
             <?php  include("./pages/profile/profile_get_check.php");  ?>
                  
            </div>
                <div class="col-md-4">
                  <div class="profile-contact">
                        <h3><?php echo _profile_contact ?></h3>
                        <div class="profile-contact-info">
                          <?php echo $Contact_Values ?>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
        <?php
            include("./sameparts/footer.php"); 
        ?>
    </div>

    <?php include("./tools/scripts.php"); ?>

    <!-- Swiper JS -->
    <script src="./z_tools/swiper.min.js"></script>
    <script>
        var galleryThumbs = new Swiper('.gallery-thumbs', {
          spaceBetween: 10,
          slidesPerView: 4,
          loop: true,
          freeMode: true,
          loopedSlides: 5, //looped slides should be the same
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
        });

        var galleryTop = new Swiper('.gallery-top', {
          spaceBetween: 10,
          loop:true,
          loopedSlides: 5, //looped slides should be the same
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          thumbs: {
            swiper: galleryThumbs,
          },
        });
    </script>

</body>

</html>



