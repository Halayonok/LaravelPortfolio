/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.toastr = require("toastr/toastr");

window.notifySuccess = (message, title) => {
    toastr.success(message, title, {timeOut: 3000});
};

window.notifyWarning = (message, title) => {
    toastr.warning(message, title, {timeOut: 3000});
};

window.notifyError = (message = 'Что-то пошло не так :(', title) => {
    toastr.error(message, title, {timeOut: 3000});
};


require('./toggle-enable.js');

require('./approve-delete');

require('./template');

require('./image-uploader');

require('./screenshot-delete');

require('bootstrap');

require('lightbox2');

window.bsCustomFileInput = require("bs-custom-file-input");
