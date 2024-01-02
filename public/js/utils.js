/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/utils.js":
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
*                   .///.
*                   (0 o)
*-------------0000--(_)--0000-------------------------
* 
*  Olha eu aqui de novo gente, deixa eu explicar.
* 
*  Esta função ficará responsável por limpar todos
*  os alertas de validações do campo em destaque,
*  de tal forma que ao digitar algo novamente no
*  no campo, eu me encarregarei de remover as 
*  validações ali presentes.
*  
*  Espero ter ajudado e sempre conte comigo.
* 
*             oooO      Oooo 
*------------(   )-----(   )--------------------------
*             \ (       ) /
*              \_)     (_/
*/
$(document).ready(function () {
  $('.rg').mask('0000000000000');
  $('.numero').mask('00000');
  $('.data').mask('00/00/0000');
  $('.cep').mask('00.000-000');
  $('.telefone').mask('(00) 0000-0000');
  $('.celular').mask('(00) 00000-0000');
  $('.cpf').mask('000.000.000-00', {
    reverse: true
  });
  $('.cnpj').mask('00.000.000/0000-00', {
    reverse: true
  });

  // Validar Erro.
  $('.validarErro').keypress(function () {
    var nameCampo = $(this).attr('name');
    $($(this)).removeClass(".form-control is-invalid");
    $('#' + nameCampo + '-error').html('');
  });
  $('.validarErro').change(function () {
    var nameCampo = $(this).attr('name');
    $($(this)).removeClass(".form-control is-invalid");
    $('#' + nameCampo + '-error').html('');
  });

  // Máscara para telefone.
  var MaskBehavior = function MaskBehavior(val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function onKeyPress(val, e, field, options) {
        field.mask(MaskBehavior.apply({}, arguments), options);
      }
    };
  $('.celphones').mask(MaskBehavior, spOptions);

  // Máscara para CPF/CNPJ.
  var CpfCnpjMaskBehavior = function CpfCnpjMaskBehavior(val) {
      return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
    },
    cpfCnpjpOptions = {
      onKeyPress: function onKeyPress(val, e, field, options) {
        field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
      }
    };
  $('.cpfCnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);

  // Inicializa o select2 na classe select2.
  $('.select2').select2({
    language: {
      searching: function searching() {
        return 'Pesquisando...';
      },
      noResults: function noResults() {
        return 'Nenhum resultado encontrado';
      }
    }
  });
  $('.custom-file-input').on('change', function () {
    //get the file name
    var fileName = $(this).val().replace('C:\\fakepath\\', " ");
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
  });
  $('#reload').click(function () {
    $.ajax({
      type: 'GET',
      url: "/reload-captcha",
      success: function success(data) {
        $(".captcha span").html(data.captcha);
      }
    });
  });
  $('#modalEnable').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var cat_id = button.data('catid');
    var cat_name = button.data('cattext');
    var modal = $(this);
    modal.find('#modalForm').attr('action', cat_id);
    modal.find('.modal-body #Modal-text').html(cat_name);
  });
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/utils.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/resources/js/utils.js */"./resources/js/utils.js");


/***/ })

/******/ });