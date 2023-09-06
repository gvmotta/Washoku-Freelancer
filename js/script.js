$('.galeria-img').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
  
  function redirectToSection(sectionId) {
    // Cria o hash a partir do ID da seção
    const hash = `#${sectionId}`;

    // Define o hash no URL, levando à seção desejada
    window.location.hash = hash;
}

$(document).ready(function() {
  $("#copiarDados").click(function() {
    // Obtenha os valores dos campos de form1
    var email = $("#email").val();
    var nome = $("#nome").val();

    // Defina os valores nos campos de form2
    $("#email2").val(email);
    $("#nome2").val(nome);
    const hash = `#form2`;
    window.location.hash = hash;
  });
});
