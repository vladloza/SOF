<?php include('header.php') ?>

<section class="margin-top">
     <div class="container">
        <div class="col-md-8" style="padding-left: 0px;">
          <img src='img/Internet-of-Things-sized.jpg'/>
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
    <section>
        <div class="container">
            <div>
                <h2 class="grey">Останні новини</h2>
            </div>
            <div class="row">
                <div>
                    <div class="col-sm-4">
                        <div class="block-inside-i">
                            <div class="block-content">
                                <a href="employee.php?id='.$row[0].'">
                                    <div class="date-wrapper">
                                        <span>21/03/2016</span>
                                    </div>
                                    <div class="image-block-wrapper">
                                        <img src="img/Add_Person.png" class="image-block"/>
                                    </div>
                                    <div class="image-caption-wrapper">
                                        <div class="image-caption">
                                            <h4>Пост о том, как мы писали олимпиаду db fb sdfb sd bs d b sd fb sd sdbsdfbsdb sdfb sdfbsdbsdfb sfb</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block-inside-i">
                            <div class="block-content">
                                <a href="employee.php?id='.$row[0].'">
                                     <div class="date-wrapper">
                                        <span>21/03/2016</span>
                                    </div>
                                    <div class="image-block-wrapper">
                                        <img src="img/Computer_Science.jpg" class="image-block"/>
                                    </div>
                                    <div class="image-caption-wrapper">
                                        <div class="image-caption">
                                            <h4>Пост о том, как мы писали олимпиаду</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block-inside-i">
                            <div class="block-content">
                                <a href="employee.php?id='.$row[0].'">
                                     <div class="date-wrapper">
                                        <span>21/03/2016</span>
                                    </div>
                                    <div class="image-block-wrapper">
                                        <img src="img/Computer_Science.jpg" class="image-block"/>
                                    </div>
                                    <div class="image-caption-wrapper">
                                        <div class="image-caption">
                                            <h4>Пост о том, как мы писали олимпиаду и скучали по родине</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="news.php" class="grey-href">Переглянути більше</a>
            </div>
        </div>
    </section>

    <script>
            $(document).ready(function() {
              var owl = $('.owl-carousel');
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
    <script src="js/owl.carousel.min.js"></script>
<?php include('footer.php') ?>