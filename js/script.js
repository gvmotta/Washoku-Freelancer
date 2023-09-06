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

  function copiarDados() {
    // Obtenha os valores dos campos de form1
    var email = document.getElementById("email").value;
    var nome = document.getElementById("nome").value;

    // Defina os valores nos campos de form2
    document.getElementById("email2").value = email;
    document.getElementById("nome2").value = nome;
  }

