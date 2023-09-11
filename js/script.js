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
    var email = $("#email1").val();
    var nome = $("#nome").val();

    // Defina os valores nos campos de form2
    $("#email2").val(email);
    $("#nome2").val(nome);
    const hash = `#form2`;
    window.location.hash = hash;
  });
});

const button = document.querySelector('#planilha');
const addLoading = () => {
  button.innerHTML = '<img src="img/loading.png" class="loading">';
}
const removeLoading = () => {
  button.innerHTML = 'Eu quero mais informações!';
}

const handleSubmit = (event) => {
  event.preventDefault(); // para não deixar recarregar a página
  addLoading();

  const data = new Date();
  const opcoes = {timezone: 'America/Sao_Paulo'};
  const horaAtual = data.toLocaleTimeString('pt-BR', opcoes);
  const dataAtual = data.toLocaleDateString('pt-BR', opcoes);
  const name = document.querySelector('input[name=name]').value;
  const email = document.querySelector('input[name=email]').value;
  const date = document.querySelector('input[name=dataNascimento]').value;
  const endereco = document.querySelector('input[name=endereco]').value;
  const estado = document.querySelector('input[name=estado]').value;
  const cidade = document.querySelector('input[name=cidade]').value;
  const gender = document.querySelector('select[name=gender]').value;
  const checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
  const selectedValues = Array.from(checkboxes).map(checkbox => checkbox.value);
  const textareaElement = document.querySelector('textarea[name=mensagem]').value;
  
  var params = {
    name: document.getElementById('nome2').value,
    email: document.getElementById('email2').value,
    message: document.getElementById('mensagem').value
  };
  
  const serviceID = "service_dgzob2h";
  const templateID = "template_kag5chc";
  
  emailjs.send(serviceID, templateID, params).then(
    res =>{
      document.getElementById('nome2').value = "";
      document.getElementById('email2').value = "";
      document.getElementById('mensagem').value = "";
      console.log(res);
    }
  )

  fetch('https://api.sheetmonkey.io/form/k96idJaL2gDuLeu1Ue65L7', {
    method: 'post',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ 'Horário': (dataAtual+horaAtual), Nome: name, Email: email, 'Data de Nascimento': date,
    'Endereço': endereco, Estado: estado, Cidade: cidade, 'Gênero': gender, 
    Cursos: selectedValues, 'Conte um pouco:': textareaElement
  }),
  }).then(() => removeLoading());
  document.getElementById("popup_container").style.display="block";  
}
document.querySelector('#form2').addEventListener('submit', handleSubmit);

function hidePopup(){      
  document.getElementById("popup_container").style.display="none";      
}