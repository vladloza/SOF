<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include('header.php');

$output = '';

$output .= '
<section>
     <div class="container">
        <div class="clearfix services-header-container">
            <div class="services-header">
                <h2>Ми навчимо Вас ПРОГРАМУВАТИ ВСЕ!</h2>
            </div>
        </div>
        <div style="background:#f5f5f5"><div class="clearfix it margin-top" >
            <div class="col-md-4 bottom-it content__container">
                <h2>Програмування даних</h2>
            </div>
            <div class="col-md-4 bottom-it">
                <div class="content__container">
                    <h2>Програмування процесів</h2>
                </div>
                <img src=\'img/pst_logo.png\' class="newimg"/>
            </div>
            <div class="col-md-4 bottom-it content__container">
                <h2>Програмування інтернет-речей</h2>
            </div>
        </div>
        <div class="clearfix">
            <h2 class="center-text">ВАШ ПРІОРИТЕТ №1  У СВІТІ ПРОГРАМУВАННЯ!</h2>
        </div></div>
        
     </div>
</section>
 <section>
        <div class="container">
            <div>
                <h2 class="center-text">Останні новини</h2>
            </div>
            <hr/>
            <div class="row">
                <div>';
try {
    
    include("dbconfig.php");
    $sqlQuery = 'select * from News order by id desc limit 3';
    
    $result = $conn->query($sqlQuery);
    
    while ($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $output .= '
<div class="col-sm-4">
    <div class="block-inside-i">
        <div class="block-content">
            <a href="item.php?id=' . $row[0] . '">
                <div class="date-wrapper">
                    <span>' . $row[3] . '</span>
                </div>
                <div class="image-block-wrapper">
                    <img class="image-block" src="data:image;base64, ' . $row[5] . '"/>
                </div>
                <div class="image-caption-wrapper">
                    <div class="image-caption">
                        <h4>' . $row[1] . '</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
';
    }
}
catch (Exeption $e) {
    echo "DB Falied!";
}

$output .= '
            </div>
        </div>
        <div class="clearfix">
            <a href="news.php" class="grey-href">Переглянути більше</a>
        </div>
        <hr/>
    </div>
</section>
<section class="margin-top">
     <div class="container">
        <div class="col-md-8" style="padding-left: 0px;">
          <img src=\'img/Internet-of-Things-sized.jpg\'/>
        </div>
        <div class="col-md-4">
          <h2>Про нас</h2>
          <p>Наша кафедра – єдина кафедра, яка має такий унікальний підбір викладачів, що створює потужну тріаду: 
            <strong>Комп’ютер-Програма-Технологія</strong>.
            Для наших студентів ми пропонуємо унікальний підбір дисциплін. Такий вибір забезпечить професійну підготовку наших студентів і комфортне входження в ІТ індустрію. Також студенти зможуть успішно працювати у стилі <strong>free</strong>.
          </p>
        </div>
      </div>
</section>
    <section>
      <div class="container">
        <div>
            <img src="img/digital-01-3.png" class="rightimg in">
          <h2>Наші викладачі  навчать  Вас :            </h2> 
            <ul class="cons">
                <li>розробляти системи підтримки прийняття рішень;</li>
                <li>розв’язувати задачі прогнозування процесів у динамічних системах;</li>
                <li>здійснювати системний аналіз взаємопов’язаних процесів різної природи;</li>
                <li>розробляти бази даних (БД) та бази знань (БЗ), проектувати логічну та фізичну структуру БД, обирати системи управління БД та БЗ;</li>
                <li>розробляти математичні моделі складних процесів.</li>
            </ul>
        </div>
      </div>
    </section>
    <section>
      <div class="container">  
        <hr>
        <div class="row">
            <div class="large-12 columns">
            <div class="owl-carousel owl-theme">
                <div class="item">
                <img src="img/partners/home-logo-celenia.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-ciklum.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-epam.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-erp.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-globallogic.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-luxoft.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-simcorp.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-softengi.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-softheme.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-softline.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-terrasoft.png" />
                </div>
                <div class="item">
                <img src="img/partners/home-logo-wincor-nixdorf.png" />
                </div>
            </div>
        </div>
      </div>
      <hr>
    </div>
</section>
<script>
        $(document).ready(function() {
            var owl = $(\'.owl-carousel\');
            owl.owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true
            });
        })
        </script>
<script src="js/owl.carousel.min.js"></script>';

echo $output;

include('footer.php');

?>