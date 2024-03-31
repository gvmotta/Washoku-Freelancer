<?php //Template name: Washoku 
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container mb-5">
      <div class="about-school">
        <div class="row pt-5">
          <div class="col-lg-6 col-sm-12 d-flex justify-content-sm-center">
            <?php
            $image_url = get_post_meta(get_the_ID(), 'washoku_image', true);
            // Verifica se há uma URL de imagem e exibe a imagem
            if (!empty($image_url)) {
              echo '<img src="' . esc_url($image_url) . '" alt="" class="img-fluid pb-3">';
            }
            ?>

          </div>
          <div class="col-lg-6 col-sm-12 d-flex align-items-center">
            <div>
              <h4 style="font-family: 'Roboto', sans-serif!important">
                <?php
                $text = get_post_meta(get_the_ID(), 'washoku_textmedium', true);
                if (!empty($text)) {
                  echo $text;
                }
                ?>
              </h4>
              <?php
              $text = get_post_meta(get_the_ID(), 'washoku_text_box', true);
              if (!empty($text)) {
                echo apply_filters('the content', $text); //aplica filtro de formatação
              }
              ?>
              <p style="display: flex">
                <?php
                $svg = get_post_meta(get_the_ID(), 'svg', true);
                if (!empty($svg)) {
                  echo "<img class='icon' src='" . $svg . "'>";
                }
                ?>
                <?php
                $text = get_post_meta(get_the_ID(), 'washoku_below_text', true);
                if (!empty($text)) {
                  echo $text;
                }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $principal_groups = get_post_meta(get_the_ID(), 'principal_group', true);
    $counter = 0;
    if (!empty($principal_groups)) {
      foreach ($principal_groups as $principal) {
        $ordem_class = $counter % 2 != 0 ? 'order-md-2' : '';
        echo '
          <div class="container ceo">
            <div class="row align-items-center">
              <div class="col-md-6 col-sm-12 ' . $ordem_class . '">';
        // isset: é uma função que verifica se a varíavel está definida e não é null, retorna true se a variável está definida e false caso esteja null
        if (isset($principal['principal_image'])) {
          echo "<img class='d-block img-fluid hiroakiUto' src='" . esc_url($principal['principal_image']) . "'>";
        }

        echo '</div>
                <div class="col-md-6 col-sm-12 mb-0' . ($ordem_class ? '' : 'order-md-2') . '">
                ';
        if (isset($principal['principal_name'])) {
          echo "<h1 class='name-ceo'>" . esc_html__($principal['principal_name']) . "</h1>";
        }
        if (isset($principal['principal_description'])) {
          $formatted_description = nl2br($principal['principal_description']);
          echo "<p>" . $formatted_description . "</p>";
        }
        echo '
                  </div>
                </div>
                </div>
                ';
        $counter++;
      }
    }
    ?>

    <div class="container py-2">
      <h1 class="text-center" style="margin-top: 30px">Instructors</h1>
      <div class="row align-items-center teachers-section mt-5">
        <div class="col-auto">
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="h1 h1left" aria-hidden="true" style="font-size: 2.5rem">&lt;</span>
            <span class="sr-only"></span>
          </button>
        </div>
        <div class="col">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php
              $teachers_groups = get_post_meta(get_the_ID(), 'professors_group', true);
              $first = true;
              if (!empty($teachers_groups)) {
                foreach ($teachers_groups as $index => $teacher) {
                  $active_class = ($index === 0) ? ' active' : '';
                  echo '
                  <div class="carousel-item' . $active_class . '">
                    <div class="row align-items-center">
                      <div class="col-md-6 col-sm-12">';
                  if (isset($teacher['professor_image'])) {
                    echo '<img class="d-block img-fluid" src="' . esc_url($teacher['professor_image']) . '" alt="2nd slide">';
                  }
                  echo '
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <span class="course-teacher course-instructor d-block"><img src="' . get_stylesheet_directory_uri() . '/img/icons/star1.svg" class="svg-instructors next-line" alt="">';
                  if (isset($teacher['professor_tag'])) {
                    echo esc_html__($teacher['professor_tag']);
                  }
                  echo '</span>
                        <h2>
                      ';
                  if (isset($teacher['professor_name'])) {
                    echo esc_html__($teacher['professor_name']);
                  }
                  echo '</h2>
                      <p>';
                  if (isset($teacher['professor_description'])) {
                    $formatted_description = nl2br($teacher['professor_description']);
                    echo $formatted_description;
                  }
                  echo '</p>
                    </div>
                </div>
              </div>';
                  $first = false;
                }
              }
              ?>

            </div>
          </div>
        </div>
        <div class="col-auto">
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="h1 h1right" aria-hidden="true" style="font-size: 2.5rem">&gt;</span>
            <span class="sr-only"></span>
          </button>
        </div>


        <div class="container mt-5">

          <?php
          $title_section = get_post_meta(get_the_ID(), 'title_card_course_section', true);
          if (!empty($title_section)) {
            echo '<h1 class="text-center" style="margin: 20px 0;">' . esc_html__($title_section) . '</h1>';
          }
          ?>
          <?php
          $desc_section = get_post_meta(get_the_ID(), 'card_course_section_description', true);
          if (!empty($desc_section)) {
            echo '' . nl2br($desc_section) . '';
          }
          ?>
          <div class="row">
            <?php
            $courses_group = get_post_meta(get_the_ID(), 'courses_group', true);
            if (!empty($courses_group)) {
              foreach ($courses_group as $course) {
                echo '
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5" onclick="redirectToSection("section1")">
                <div class="card-courses">
                  ';
                if (!empty($course['card_course_image'])) {
                  echo '<img src="' . $course['card_course_image'] . '" class="card-img-top" alt="Card Image">';
                }
                echo '<div class="gradient-overlay"></div>';
                if (!empty($course['card_course_name'])) {
                  echo '<h5 class="card-title">' . $course['card_course_name'] . '</h5>';
                }

                echo '<i class="fas fa-chevron-up arrow-icon"></i>
                </div>
              </div>
              ';
              }
            }
            ?>
          </div>
        </div>

        <div>
          <?php
          $course_groups = get_post_meta(get_the_ID(), 'course_group', true);
          $counter_course = 1;
          if (!empty($course_groups)) {
            foreach ($course_groups as $course) {
              $ordem_course = $counter_course % 2 == 0 ? 'order-md-2' : '';
              echo '
              <div class="container mt-5 courses" id="section"' . $counter_course . '">
            <div class="row">
              <div class="col-lg-6 col-md-12 ' . $ordem_course . '">
                <div class="img-course d-flex align-items-center justify-content-center">
              ';
              if (isset($course['course_image'])) {
                echo '<img src="' . $course['course_image'] . '" alt="Image" class="img-fluid">';
              }
              echo '
              </div>
              </div>
              <div class="col-lg-6 col-md-12' . ($ordem_course ? '' : ' order-md-2') . '">
                <div class="p-4">
              ';
              if (isset($course['course_name'])) {
                echo '<h2>' . $course['course_name'] . '</h2>';
              }
              if (isset($course['course_tag'])) {
                echo '<p class="course-sample"><i class="fa-solid fa-angle-left"></i>' . $course['course_tag'] . '<i class="fa-solid fa-angle-right"></i></p>';
              }
              if (isset($course['course_duration'])) {
                echo '<span class="course-teacher d-block">' . $course['course_duration'] . '</span>';
              }
              if (isset($course['course_description'])) {
                echo '<p class="py-0 px-0">' . $course['course_description'] . '</p>';
              }
              echo '</div>
              </div>
            </div>
          </div>
        </div>';
              $counter_course++;
            }
          }
          ?>




          <h2 class="px-2 text-center text-white w-75 m-auto" style="font-family: 'MrsEavesSmallCapsRoman';">
            <?php
            $title = get_post_meta(get_the_ID(), 'quality_cards_title_section', true);
            if (!empty($title)) {
              echo $title;
            }
            ?>
          </h2>
          <div class="container d-flex">
            <?php
            $card_quality_group = get_post_meta(get_the_ID(), 'quality_cards', true);
            echo '<div class="row py-5 m-auto">';
            if (!empty($card_quality_group)) {
              foreach ($card_quality_group as $card) {
                echo '
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-4">
                  <div class="card-div">
                    <div class="card-icon">';
                if (isset($card['card_quality_image'])) {
                  echo '<img class="turmas-img" src="' . $card['card_quality_image'] . '" alt=""></div>';
                  echo '<h5 class="mini-card-title align-items-center d-flex justify-content-center">' . $card['card_quality_description'] . '</h5>';
                  echo '</div>
                </div>';
                }
              }
            }
            ?>
          </div>

        </div>

        <div class="container">
          <div class="galeria m-auto">
            <?php
              $title = get_post_meta(get_the_ID(), 'carousel_images_title', true);
              if (!empty($title)) {
                echo '<h2 class="text-center mb-5">' . $title . '</h2>';
              }
              $carousel_images_group = get_post_meta(get_the_ID(), 'carousel_images_group', true);
              $cont = 0;
              if (!empty($carousel_images_group)) {
                echo '<div class="galeria-img">';   
                foreach ($carousel_images_group as $image) {
                  echo '<img id="myImg' . $cont . '" class="ms-1 me-1 img-gallery" src="';
                  if(isset($image['carousel_image'])) {
                    echo $image['carousel_image'];
                  }
                  echo '" alt="';
                  if(isset($image['carousel_images_text_box'])) {
                    echo $image['carousel_images_text_box'];
                  }
                  echo '" width="300" height="200">';
                }
                echo '</div>';
              }
            ?>
              
          </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>

        <div class="container">
          <h2 class="mt-5 mb-4 text-center">Interested?</h2>
          <div class="row">
            <div class="image-form col-lg-6 col-md-12 col-sm-12 d-flex">
              <img class="img-fluid img-form m-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/img-form1.png" alt="">
            </div>
            <div class="form col-lg-6 col-md-12 col-sm-12">
              <form id="form2" action="https://formspree.io/f/moqowool" method="POST">
                <div class="mb-3">
                  <label for="nome2" class="form-label">Full Name:</label>
                  <input type="text" class="form-control" id="nome2" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                  <label for="country" class="form-label">Nacionality:</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter the country you live in" required>
                </div>
                <div class="mb-3">
                  <label for="email2" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email2" name="email" placeholder="Enter your best email" required>
                </div>
                <div class="mb-3">
                  <label for="telefone" class="form-label">Cell Phone:</label>
                  <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Phone Number" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Your Culinary Interest:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sushi-course" nome="Sushi" value="sushi-course">
                    <label class="form-check-label" for="sushi-course">Sushi</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="yakitori-course" nome="Yakitori" value="yakitori-course">
                    <label class="form-check-label" for="yakitori-course">Yakitori</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ramen-course" nome="Ramen" value="ramen-course">
                    <label class="form-check-label" for="ramen-course">Ramen</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="complete-course" nome="Curso-completo" value="complete-course">
                    <label class="form-check-label" for="complete-course">All-Around (General) Japanese</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="mensagem" class="form-label">Tell Us about You and Your Culinary Objective</label>
                  <textarea class="form-control-lg" id="mensagem" placeholder="Tell us..." name="mensagem" rows="4" required></textarea>
                </div>
                <input type="hidden" class="form-control" id="version" name="version" value="English-Global">
                <button type="submit" class="btn btn-primary mb-5" id="planilha">I WANT TO KNOW MORE!</button>
              </form>
            </div>
          </div>
        </div>

        <div id="popup_container">
          <div id="popup">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/checkGreen.png" class="justify-content-center" alt="">
            <h2>We are very happy!</h2>
            <p>Your information has been sent! We will contact you soon!</p>
            <button onclick="hidePopup()">Ok</button>
          </div>
        </div>
        <script>
          console.log("1");
        </script>
        <script type="text/javascript">
          
        </script>
    <?php endwhile;
else : endif; ?>
    <?php get_footer(); ?>