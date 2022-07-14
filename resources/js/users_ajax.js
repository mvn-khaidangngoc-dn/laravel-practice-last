$(document).ready(function(e) {

    $('.sort_name').on('click', function() {
        var sort = $('.sort_name').attr('data-sort');
        if (sort == 'ASC') {
            $(this).attr('data-sort', 'DESC');
            $('.sort_type').val('ASC');
            $('.sort_name i').removeClass('fa-sort-down');
            $('.sort_name i').removeClass('fa-sort');
            $('.sort_name i').addClass('fa-sort-up');
        } else {
            $(this).attr('data-sort', 'ASC');
            $('.sort_type').val('DESC');
            $('.sort_name i').addClass('fa-sort-down');
            $('.sort_name i').removeClass('fa-sort');
            $('.sort_name i').removeClass('fa-sort-up');
        }
        loadDataUser();
    })

    $('.sort_ID').on('click', function() {
        var sort = $('.sort_ID').attr('data-sort');
        if (sort == 'ASC') {
            $(this).attr('data-sort', 'DESC');
            $('.sort_type_id').val('ASC');
            $('.sort_ID i').removeClass('fa-sort-down');
            $('.sort_ID i').removeClass('fa-sort');
            $('.sort_ID i').addClass('fa-sort-up');
        } else {
            $(this).attr('data-sort', 'ASC');
            $('.sort_type_id').val('DESC');
            $('.sort_ID i').addClass('fa-sort-down');
            $('.sort_ID i').removeClass('fa-sort');
            $('.sort_ID i').removeClass('fa-sort-up');
        }
        loadDataUser();
    })

    loadDataUser();

    function loadDataUser() {
        var sort = $('.sort_type').val();
        var sort_ID = $('.sort_type_id').val();
        $.ajax({
            url: '/users-ajax/getDataTable',
            type: "GET",
            data: { sort : sort , sort_ID:sort_ID },
            success: function(res) {
                // console.log(res);
                var html = '';
                var data = res.data;
                $.each(data, function(k, v) {
                    html += '<tr>';
                    html += '<td>' + v.id + '</td>';
                    html += '<td>' + v.name + '</td>';
                    html += '<td>' + v.email + '</td>';
                    html += ' <td>' + v.status + '</td>';
                    html += ' <td>' + v.posts.length + '</td>';
                    html += ' <td>' + v.comments.length + '</td>';
                    html += '<td>';
                    html += '<button type="button" name="button" class="btn btn-secondary edit_user" data-id="' + v.id + '" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fas fa-edit"></i></button>';
                    html += '<button type="button" name="button" class="btn btn-danger delete_user" data-id="' + v.id + '" data-name="' + v.name + '" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fas fa-trash-alt"></i></button>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('tbody').html(html);
            }
        });
    }

    function searchName() {
        $("#search-bar").keyup(function(e) {
            var name = $("#search-bar").val();
            console.log(name);
            if (name.length == 0) {
                loadDataUser();
            } else {
                $.ajax({
                    url: "/users-ajax/search-name",
                    type: "POST",
                    data: {name:name},
                    success: function(res) {
                        var html = '';
                        var data = res.data;
                        $.each(data, function(k, v) {
                            html += '<tr>';
                            html += '<td>' + v.id + '</td>';
                            html += '<td>' + v.name + '</td>';
                            html += '<td>' + v.email + '</td>';
                            html += '<td>' + v.created_at + '</td>';
                            html += ' <td>' + v.status + '</td>';
                            html += ' <td>' + v.posts.length + '</td>';
                            html += ' <td>' + v.comments.length + '</td>';
                            html += '<td>';
                            html += '<a href="/users/' + v.id + '/comments" type="button" class="btn btn-info">Show C</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('tbody').html(html);
                    }
                });
            }
        });
    }

    function searchPostTotal() {
        $("#search-bar").keyup(function(e) {
            var content = $("#search-bar").val();
            if (content.length == 0) {
                loadDataUser();
            } else {
                $.ajax({
                    url: "/users-ajax/search-post-total",
                    type: "post",
                    data: {count : content},
                    success: function(res) {
                        var html = '';
                        var data = res.data;
                        $.each(data, function(k, v) {
                            html += '<tr>';
                            html += '<td>' + v.id + '</td>';
                            html += '<td>' + v.name + '</td>';
                            html += '<td>' + v.email + '</td>';
                            html += '<td>' + v.created_at + '</td>';
                            html += ' <td>' + v.status + '</td>';
                            html += ' <td>' + v.posts.length + '</td>';
                            html += ' <td>' + v.comments.length + '</td>';
                            html += '<td>';
                            html += '<a href="/users/' + v.id + '/comments" type="button" class="btn btn-info">Show C</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('tbody').html(html);
                    }
                });
            }
        });
    }

    function searchCommentTotal() {
        $("#search-bar").keyup(function(e) {
            var content = $("#search-bar").val();
            if (content.length == 0) {
                loadDataUser();
            } else {
                $.ajax({
                    url: "/users-ajax/search-comment-total",
                    type: "post",
                    data: { count:content },
                    success: function(res) {
                        var html = '';
                        var data = res.data;
                        $.each(data, function(k, v) {
                            html += '<tr>';
                            html += '<td>' + v.id + '</td>';
                            html += '<td>' + v.name + '</td>';
                            html += '<td>' + v.email + '</td>';
                            html += '<td>' + v.created_at + '</td>';
                            html += ' <td>' + v.status + '</td>';
                            html += ' <td>' + v.posts.length + '</td>';
                            html += ' <td>' + v.comments.length + '</td>';
                            html += '<td>';
                            html += '<a href="/users/' + v.id + '/comments" type="button" class="btn btn-info">Show C</a>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('tbody').html(html);
                    }
                });
            }
        });
    }

    $('#type-search').change(function() {
        type = $(this).val();
        console.log(type);
        if (type == 0) {
            searchName();
        } else if (type == 1) {
            searchPostTotal();
        } else {
            searchCommentTotal();
        }
    });

    $('#createUser').on('click', function() {
        $('#modal-create').modal('show');
        $('#button-finish').fadeOut();
    })

    // Add New user
    $('#button-create').on('click', function() {
        var form = new FormData($('#form-user')[0]);
        $.ajax({
            type: "post",
            url: "/users/storeAjax",
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response) {
                    var html = '<p class="text-success">' + response + '</p>';
                    $('#notication').html(html);
                    $('#form-user')[0].reset();
                    $('#form-user').css('opacity', 1);
                    $('#button-create').attr('disabled', false);
                    $('#form-user').attr('disabled', false);
                    $('#button-create').fadeOut();
                    $('#button-finish').fadeIn();
                } else {
                    var html = '<p class="text-danger">Add New User Failed!!!</p>';
                    $('#notication').html(html);
                    $('#form-user').css('opacity', 1);
                    $('#button-submit').attr('disabled', false);
                    $('#form-user').attr('disabled', false);
                    $('#button-create').fadeOut();
                    $('#button-finish').fadeIn();
                }
                loadDataUser();
            },
            error: function(e) {
                console.log(e);
                var html = '<p class="text-danger">Create / Update User Failed!</p>';
                $('#notication').html(html);
                $('#form-group-product').css('opacity', 1);
                $('#button-create').attr('disabled', false);
                $('#form-group-product').attr('disabled', false);
            }
        });
    })

    //Delete
    $(document).on('click', '.delete_user', function() {
        $('tr').removeClass('choose-group');
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#modal-delete').modal('show');
        $('#button-finish-delete').fadeOut();
        $('#modal-delete .modal-title').text('Delete User');
        $('#notication-delete').html('<span>Do you want delete User <b class="text-danger">' + name + '</b>?');
        $('#button-delete').attr('data-id', id);
        $('#button-delete').fadeIn();
        $(this).closest('tr').addClass('choose-group');
    })

    $('#button-delete').on('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/users/deleteAjax',
            type: 'post',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                console.log(data);
                var html = '';
                if (!data.error) {
                    html += '<span class="text-success">Delete User Successfully!!</span>';
                    $('#button-delete').fadeOut();
                    $('#button-finish-delete').fadeIn();
                } else {
                    var html = '<span class="text-danger">' + data.message + '</span>';
                }
                $('#button-delete').attr('disabled', false);
                $('#notication-delete').html(html);
                loadDataUser();
            },
            error: function(e) {
                console.log(e);
                var html = '<span class="text-danger">User group query error!!</span>';
                $('#notication-delete').html(html);
                $('#button-delete').attr('disabled', false);
            }
        });
    })

    $(document).on('click', '.edit_user', function() {
        $('#modal-update').modal('show');
        $('#button-finish-update').fadeOut();
        $('#button-update').fadeIn();
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/users-ajax/getDataEdit',
            type: 'GET',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                if (data) {
                    $('#id_update').val(data.id);
                    $('#name_update').val(data.name);
                    $('#email_update').val(data.email);
                    var now = new Date(data.birthday);
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
                    $('#birthday_update').val(today);
                    var html1 = '';
                    if(data.status == 0 ){
                        html1 += '<option value="'+ data.status +'" selected disabled>Active</option>';
                        html1 += '<option value="1">No Active</option>';
                    }else {
                        html1 += '<option value="0">Active</option>';
                        html1 += '<option value="'+ data.status +'" selected disabled>No Active</option>';
                    }
                    $('#status_update').html(html1);
                    $('#status_update').val(data.status);
                    $('#avatar_update').text(data.avatar);

                } else {
                    var html = '<span class="text-danger">' + data.message + '</span>';
                    $('#notication-update').html(html);
                }
                loadDataUser();
            },
            error: function(e) {
                console.log(e);
                var html = '<span class="text-danger">User group query error!!</span>';
                $('#notication-update').html(html);
                $('#button-update').attr('disabled', false);
            }
        });
    })


    $('#button-update').on('click', function() {
        var form = new FormData($('#form-user-update')[0]);
        $.ajax({
            url: '/users-ajax/updateUser',
            type: 'post',
            dataType: 'json',
            data: form,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                var html = '';
                if (!data.error) {
                    html += '<span class="text-success">Update User Successfully!!</span>';
                    $('#button-update').fadeOut();
                    $('#button-finish-update').fadeIn();
                } else {
                    var html = '<span class="text-danger">' + data.message + '</span>';
                }
                $('#button-update').attr('disabled', false);
                $('#notication-update').html(html);
                $('#button-finish-update').fadeIn();
                loadDataUser();
            },
            error: function(e) {
                console.log(e);
                var html = '<span class="text-danger">User group query error!!</span>';
                $('#notication-update').html(html);
                $('#button-update').attr('disabled', false);
            }
        });
    })

});
