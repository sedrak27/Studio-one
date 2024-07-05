$(document).ready(function () {
    $.ajax({
        url: url + '/all-posts',
        method: 'GET',
        success: function (response) {
            drawData(response)
        }
    });

    $('#user-posts').click(function (event) {
        location.href = url + '/posts';


        $.ajax({
            url: $(this).data('href'),
            method: 'GET',
            success: function (response) {
                drawData(response)
            }
        });

    });

    function drawData(response) {
        $('#post').empty();
        $('#pages').empty();

        response.data.forEach(function (item) {
            $('#post').append(
                `<div class="card mt-2">
                    <div class="card-header"><strong>${item.title}</strong> ${userId == item.user_id ? `<a class="edit btn btn-warning" href="/edit/posts/${item.id}">Edit</a> <a class="delete btn btn-danger" href="/posts/${item.id}">Delete</a>` : ''} </div>
                    <div class="card-body">
                        <p>${item.content}</p>
                    </div>
                    <div class="d-flex flex-column justify-content-around">
                        <div>
                            <span class="comment btn btn-primary">Comment ${item.comments.length}</span>
                            <input class="current-id" type="hidden" value="${item.id}">
                            <input class="current-user-id" type="hidden" value="${item.user_id}">
                        </div>
                    </div>
                </div>`
            )
        });

        if (response.data.length > 0) {
            response.links.forEach(function (item) {
                $('#pages').append(
                    `<a class="btn ${item.active ? 'btn-success' : 'btn-primary'} pages" href="${item.url}">${item.label}</a>`
                )
            });
        }

        $('.delete').click(function (event) {
            event.preventDefault();

            let selfe = this;

            $.ajax({
                url: url + $(selfe).attr('href'),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                success: function () {
                    $(selfe).closest('.card').remove();
                }
            });
        })

        $('.pages').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: event.target.href,
                method: 'GET',
                success: function (response) {
                    drawData(response);
                }
            })
        });

        $('.comment').click(function () {
            const self = this;
            const postId = $(self.parentElement.children)[1].value;
            if (!$(`#comment-${postId}`).length) {
                $.ajax({
                    url: url + `/posts/${postId}/comments`,
                    method: 'GET',
                    success: function (response) {
                        response.comments.forEach(function (comment) {
                            $(self.parentElement).append(
                                `<div class="post-comments col-lg-12 text-center pt-2">
                                <h6>${comment.user.first_name + ' ' + comment.user.last_name}</h6>
                                <p>${comment.text}</p>
                                <hr>
                            </div>`
                            );
                        });

                        $(self.parentElement).append(
                            $(`
                                <div id="comment-${postId}" class="comment-form col-lg-12 d-flex">
                                    <form action="/comment" method="POST">
                                        <input type="text" name="text">
                                        <button class="btn btn-primary" type="submit">Add</button>

                                        <input type="hidden" name="post_id" value="${postId}">
                                        <input type="hidden" name="_token" value="${csrf}">
                                    </form>
                                </div>
                            `)
                        );
                    }
                });
            } else {
                $('.post-comments').remove();
                $('.comment-form').remove();
            }
        });
    }

    $('#search-form').submit(function (event) {
        event.preventDefault();

        const query = $(this).serialize();

        if (query.split('=').pop()) {
            ($.ajax({
                url: $(this)[0].action + '?' + query,
                method: 'GET',
                success: function (response) {
                    $('#post').empty();

                    drawData(response)
                }
            }))
        }
    });

});
