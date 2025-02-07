$(document).ready(function () {
    $("#ajax-contact").on("submit", function (e) {
      e.preventDefault(); // Evita el envío normal del formulario

      // Envía los datos del formulario usando AJAX
      $.ajax({
        url: "assets/phpscripts/contact.php", // Ruta al archivo PHP
        type: "POST",
        data: $(this).serialize(),
        success: function (response) {
          const result = JSON.parse(response); // Parsea la respuesta JSON

          if (result.status === "success") {
            // Muestra el mensaje de éxito
            $("#msgSubmit").removeClass("hidden").show();
            $("#msgError").hide(); // Oculta el mensaje de error si existe
            $("#ajax-contact")[0].reset(); // Limpia el formulario
          } else {
            // Muestra el mensaje de error
            $("#msgError").removeClass("hidden").show();
            $("#msgSubmit").hide(); // Oculta el mensaje de éxito si existe
          }
        },
        error: function () {
          // Maneja errores de red u otros problemas
          $("#msgError").removeClass("hidden").show();
          $("#msgSubmit").hide();
        },
      });
    });
  });