<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/logo.ico" type="image/x-icon">
  <!-- Bootstrap Css Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Slick Links -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/slick/slick-theme.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <?php wp_head(); ?>
</head>

<body>
  <div class="hero-header">
    <div class="container">
      <div class="row pt-2">
        <div class="col-lg-6 col-sm-12 mb-lg-5">
          <div class="logo-hero d-flex mb-4 align-items-center justify-content-lg-start justify-content-center">
            <img class="mr-4" src="<?php  
              $image = get_post_meta(get_the_ID(), 'enterprise_logo', true);
              if(!empty($image)) {
                echo $image;
              }
            ?>">
            <div class="text-logo">
              <h3 class="enterprise-name">  
              <?php 
                $text = get_post_meta( get_the_ID(), 'enterprise_name', true );

                // Verifica se há uma URL de imagem e exibe a imagem
                if (!empty($text)) {
                  echo $text;
                } 
              ?>  
              <br></h3>
              <div class="BringupLogo">
                <?php
                  $text = get_post_meta(get_the_ID(), 'enterprise_subname', true);
                  if (!empty($text)) {
                    echo $text;
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="mb-md-5">
            <h1 class="mb-4 text-lg-left text-center logo-text">
              <?php
                $text = get_post_meta(get_the_ID(), 'call_to_action_title', true);
                if (!empty($text)) {
                  echo $text;
                }
              ?>
              <div class="bold-head font-italic" style="display: inline;font-size: 40px; font-family: 'MrsEavesSmallCapsRoman'!important">
                <?php
                  $text = get_post_meta(get_the_ID(), 'call_to_action_subtitle', true);
                  if (!empty($text)) {
                    echo $text;
                  }
                ?>
              </div>
            </h1>
          </div>
          <!-- <p class="text-md-left text-lg-left">UNVEILING OUR INNOVATIVE JAPANESE CULINARY SCHOOL</p>
          <ul>
            <li>RAPIDLY Transforming You into a Chef</li>
            <li>TAILORING Unique Curricula for Every Student</li>
            <li>EMBRACING All Skill Levels</li>
            <li>Universal Language Support with Portable AI Device</li>
            <li>All Classes are Conducted In-Person in Japan</li>
          </ul> -->
          <!-- <p class="text-md-left text-lg-left">Discover the Art of Japanese Cuisine <span
              class="font-weight-bold">"Washoku"</span> in Japan with Intensive Culinary Courses!</p>
          <p class="font-weight-bold text-md-left text-lg-left">All Classes are Conducted In-Person in Japan</p> -->
          <form id="form1">
            <div class="form-group">
              <input class="form-control" type="text" id="nome" name="nome" aria-describedby="nameHelp"
                placeholder="Full Name">
            </div>
            <div class="form-group">
              <input class="form-control" type="email" id="email1" name="email1" aria-describedby="emailHelp"
                placeholder="Type your e-mail">
            </div>
            <button class="mb-sm-4 btn first-btn" type="button" id="copiarDados">I want to know more!</button>
          </form>
        </div>
        <div class="col-lg-6 col-sm-12 text-center align-self-end">
          <img class="img-fluid img-owner" src="
          <?php
            $image = get_post_meta(get_the_ID(), 'image_hero', true);
            if(!empty($image)) {
              echo $image;
            }
          ?>
          " alt="">
        </div>
      </div>
    </div>
  </div>