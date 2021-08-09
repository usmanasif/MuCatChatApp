import Echo from 'laravel-echo';

window.$ = window.jQuery = require('jquery');
window.io = require('socket.io-client');


window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    cors: {origin: "*"}
});

$(document).ready(function () {
    window.users = [];
    window.Echo
        .join('online-users')
        .here(users => {
            console.log(users);
            window.users = users;
            const is_present = users.filter((usr) => {return usr.id === receiver_id})
            if(is_present.length) {
                $('#status').html('Online')
            }
        })
        .joining(user => {
            // When another user joins this will fire with the user who logged in.
            if (user.id === receiver_id) {
                $('#status').html('Online')
            }
        })
        .leaving(user => {
            // When the users connection is lost, we get the object of the user who has left.
            if (user.id === receiver_id) {
                $('#status').html('Offline')
            }
        });


    window.Echo.private(`user-messanger-${user_id}-${receiver_id}`)
        .listen("MessagePushEvent", (source) => {
            debugger
            let message = `<div class="self-start w-3/4 my-2">
                            <div class="p-4 text-sm bg-white rounded-t-lg rounded-r-lg shadow">
                                ${source.message.message_source}
                            </div>
                        </div>`
            $('#messag-chat-box').append(message)
        });

})
