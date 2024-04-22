<!-- Alert Start -->
  <div class="alert alert-warning col-md-12" role="alert" id="notes">
    <h4> Notlar</h4>
      <ul><b>
        <li> Lisans Durumu : 01/03/2020 Tarihine Kadar Etkinleştirilmesi Gerekiyor !</li>
        <li> Ödeme işlemini Havale Ve EFT ile Yapabilirsiniz</li>
        <li> Ödeme için alt tarafda daha tedaylı olarak açıklanmaktadır.</li>
        </b>
      </ul>
  </div> 
<!-- Alert End -->
    
<!-- Col Start -->
<div class="col-md-12 grid-margin stretch-card">
  <!-- Card Start -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo _lisence;?></h4>

        <!-- Lisance Start -->
        <div class="lisence">
          <div class="img"><img src="./assets/images/banks/garanti.png" alt="Garanti"></div>
            <div class="iban">
              <div class="text"><h4>Alıcı Adı : Matrix Teklonoji A.Ş.</h4></div>
              <input type="text" id="iban_garanti" value="TR96 0006 2000 0180 0006 2945 91" disabled >
              <a href="javascript:void(0)" onclick="copyText();">  <i class="mdi mdi-content-copy"></i></a>
            </div>
        </div> <!-- Lisance End -->
        <!-- Lisance Start --><br><br>
        <div class="lisence">
        
              <div class="text">
                <h4>Havale ve EFT için gerekli bilgiler;</h4>
                <h5>Müşteri ID : <b><?php echo $self_id;?></b></h5>
                <h5>Yıllık Lisans Bedeli : <b>200 Türk Lirası</b></h5>
                <h5>Alıcı Adı: <b>Matrix Teklonoji A.Ş.</b></h5>
                <br><h4>Firma Bilgileri ;</h4>
                <h5>Telefon Numarası :<b> <?php echo "0".$c_tel;?></b></h5>
                <h5>Firma Adı: <b><?php echo $c_name;?></b></h5>
                <h5>E-Posta : <b><?php echo $email;?></b></h5>
              </div>
              <br>
              <p id="eft-reg">Zorunlu Alanlar: <B>Müşteri ID, Alıcı Adı, Telefon Numarası (Kişisel Olabilir)</B></p>
              <p id="eft-noreg">İstege Bağlı: <B>E-posta, Firma Adı</B></p>

        </div> <!-- Lisance End -->





    </div> <!-- Card Body End -->
  </div> <!-- Card End -->
</div> <!-- Col End -->


<script>
  function copyText() {    
    document.getElementById("iban_garanti").disabled = false;
    var copyText = document.getElementById("iban_garanti");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.getElementById("iban_garanti").disabled = true;
    alert("IBAN Adresi Kopyalandı");
  }
</script>