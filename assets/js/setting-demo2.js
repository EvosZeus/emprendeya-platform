"use strict";

// Setting Color

$(window).resize(function () {
  $(window).width();
});

getCheckmark(); // Se asegura que el checkmark esté en el botón correcto al cargar

$(".changeBodyBackgroundFullColor").on("click", function () {
  if ($(this).attr("data-color") == "default") {
    $("body").removeAttr("data-background-full");
  } else {
    $("body").attr("data-background-full", $(this).attr("data-color"));
  }

  $(this).parent().find(".changeBodyBackgroundFullColor").removeClass("selected");
  $(this).addClass("selected");
  // layoutsColors(); // Comentado porque no se define en este fragmento, pero si existe y es relevante, déjalo
  getCheckmark();
});

$(".changeLogoHeaderColor").on("click", function () {
  if ($(this).attr("data-color") == "default") {
    $(".logo-header").removeAttr("data-background-color");
  } else {
    $(".logo-header").attr("data-background-color", $(this).attr("data-color"));
  }

  $(this).parent().find(".changeLogoHeaderColor").removeClass("selected");
  $(this).addClass("selected");
  customCheckColor(); // Cambia el logo basado en el color del header del logo
  // layoutsColors(); // Comentado
  getCheckmark();
});

$(".changeTopBarColor").on("click", function () {
  var newColor = $(this).attr("data-color"); // Obtener el color seleccionado

  if (newColor == "default") {
    $(".main-header .navbar-header").removeAttr("data-background-color");
  } else {
    $(".main-header .navbar-header").attr("data-background-color", newColor);
  }

  $(this).parent().find(".changeTopBarColor").removeClass("selected");
  $(this).addClass("selected");
  // layoutsColors(); // Comentado

  // ----- INICIO DE LA LÓGICA AÑADIDA -----
  var $body = $('body');
  // Colores que consideramos "oscuros" para el topbar
  var darkColors = ["dark", "dark2", "blue2", "purple2", "light-blue2", "green2", "orange2", "red2"]; 
  // (Añade aquí otros data-color que tu tema use para fondos oscuros del topbar si es necesario)

  if (darkColors.includes(newColor)) {
    $body.addClass('topbar-text-light');
    console.log("Se añadió la clase 'topbar-text-light' al body.");
  } else {
    // Si es "default" o "white" o cualquier otro color claro
    $body.removeClass('topbar-text-light');
    console.log("Se removió la clase 'topbar-text-light' del body.");
  }
  // ----- FIN DE LA LÓGICA AÑADIDA -----

  getCheckmark();
});

$(".changeSideBarColor").on("click", function () {
  if ($(this).attr("data-color") == "default") {
    $(".sidebar").removeAttr("data-background-color");
  } else {
    $(".sidebar").attr("data-background-color", $(this).attr("data-color"));
  }

  $(this).parent().find(".changeSideBarColor").removeClass("selected");
  $(this).addClass("selected");
  // layoutsColors(); // Comentado
  getCheckmark();
});

$(".changeBackgroundColor").on("click", function () {
  // Primero quitar cualquier clase de color de fondo existente
  // Esto es especulativo, necesitas ver qué atributos/clases usa tu tema para el fondo del body
  var existingColors = ["default", "white", "dark"]; // Ejemplo de colores que podrían estar como data-attributes
  existingColors.forEach(function(color) {
    if ($("body").attr("data-background-color") === color) {
        $("body").removeAttr("data-background-color");
    }
  });
  // Quitar también el atributo de fondo completo si existe
  $("body").removeAttr("data-background-full");


  // Aplicar el nuevo color
  var newBgColor = $(this).attr("data-color");
  if (newBgColor !== "default") {
      $("body").attr("data-background-color", newBgColor);
  }
  
  $(this).parent().find(".changeBackgroundColor").removeClass("selected");
  $(this).addClass("selected");
  getCheckmark();
});

function customCheckColor() {
  var logoHeader = $(".logo-header").attr("data-background-color");
  if (logoHeader && logoHeader !== "white" && logoHeader !== "default") { // Considerar "default" como claro también
    $(".logo-header .navbar-brand").attr("src", "assets/img/emprendeya/logo_light.png");
  } else {
    $(".logo-header .navbar-brand").attr("src", "assets/img/emprendeya/logo_dark.png");
  }
}

var toggle_customSidebar = false,
  custom_open = 0;

if (!toggle_customSidebar) {
  var toggle = $(".custom-template .custom-toggle");

  toggle.on("click", function () {
    if (custom_open == 1) {
      $(".custom-template").removeClass("open");
      toggle.removeClass("toggled");
      custom_open = 0;
    } else {
      $(".custom-template").addClass("open");
      toggle.addClass("toggled");
      custom_open = 1;
    }
  });
  toggle_customSidebar = true;
}

function getCheckmark() {
  var checkmark = `<i class="gg-check"></i>`; // Usar backticks para template literals
  $(".btnSwitch").find("button").empty();
  $(".btnSwitch").find("button.selected").append(checkmark);
}

// Inicializar el estado correcto del texto del topbar al cargar la página,
// basado en el color actual del topbar (si ya está seleccionado).
$(document).ready(function() {
    var $currentTopBarButton = $(".changeTopBarColor.selected");
    if ($currentTopBarButton.length) {
        var currentColor = $currentTopBarButton.attr("data-color");
        var $body = $('body');
        var darkColors = ["dark", "dark2", "blue2", "purple2", "light-blue2", "green2", "orange2", "red2"];

        if (darkColors.includes(currentColor)) {
            $body.addClass('topbar-text-light');
            console.log("Estado inicial: Se añadió 'topbar-text-light' basado en el botón seleccionado.");
        } else {
            $body.removeClass('topbar-text-light');
            console.log("Estado inicial: Se removió 'topbar-text-light' basado en el botón seleccionado.");
        }
    }
    // También, es importante llamar a customCheckColor al inicio para el logo
    customCheckColor();
});