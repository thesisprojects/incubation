window.Vue = require('vue');

window.routes = {
    'roleedit': $('#route').text()
}
$('#route').remove();

let route = window.routes.roleedit;

const editroleapp = new Vue({
    el: '#editroleapp',
    data: {
        role: $('#role').val()
    },
    methods: {
        togglePermission: function (permission) {
            $('#save-loader').show();
            axios.post(route, {
                permission: permission,
                role: this.role
            }).then(function (response) {
                $('#save-loader').hide();
                $("#response-display").append('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.data.message + '</div>');
            }).catch(function (error) {
                $('#save-loader').hide();
                $("#response-display").append('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + error.data.message + '</div>');
            });
        }
    }
});

require('./bootstrap');