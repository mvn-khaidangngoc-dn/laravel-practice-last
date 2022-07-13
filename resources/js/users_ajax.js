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
    })
});
