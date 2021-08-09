require('./bootstrap');

import Alpine from 'alpinejs';
window.$ = window.jQuery = require('jquery');

import './socket'

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function () {

    $('#chatbox-form').on('submit', (e) => {
        e.preventDefault();
        const message_div = $("input[name='message']")
        let message = `<div class="self-end w-3/4 my-2 bg-green-200">
            <div class="p-4 text-sm bg-white rounded-t-lg rounded-l-lg shadow bg-green-200">
                ${message_div.val()}
            </div>
        </div>`

        $('#messag-chat-box').append(message)

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'post',
            url: '/messages',
            data: $('#chatbox-form').serializeArray(),
            success: response => {
                message_div.val('')
            }
        })

    });
    $('.link-user').on('click', (e) => {
        let url = `http://${window.location.host}/conversations/${$(event.currentTarget).attr('target')}`;
        window.location = url
    });

});
