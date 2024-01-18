var post_principal = $("#post_principal")
var posts = $('#posts')
var total_posts = 0
const POSTS_PER_PAGE = 20
const POSTS_URL = 'php/posts.php'

function create_post(data) {
    var container = $('<div>')
    var title = $('<h3>')
    title.text(data.title)

    var date = $('<span>')
    date.attr('class', 'date')
    date.text(data.date)
    title.append(date)

    var description = $('<p>')
    description.text(data.description)

    var video_container = $('<div>')
    video_container.attr('class', 'ratio ratio-16x9')
    var video = $('<iframe>')
    video.attr({src: data.video, allowfullscreen: ''})
    video_container.append(video)

    container.append(title)
    container.append(date)
    container.append(description)
    container.append(video_container)

    return container
}

function create_main_post(data) {
    post_principal.html(create_post(data))
}

function add_posts(data) {
    data.forEach((d) => {
        var post = create_post(d)
        post.attr('class', 'col p-3 border border-light rounded-5')
        posts.append(post)
    })
}

$(document).ready(function() {
    $.getJSON(POSTS_URL, {
        page: 0,
        count: POSTS_PER_PAGE
    }, function(data) {
        total_posts = data.metadata.total_entries
        create_main_post(data.data[0])
        add_posts(data.data.slice(1))
    })
    .fail((d) => {
        console.log(d.responseText)
    })
})

var getting_posts = false
var index = 1
$(document).scroll(function() {
    // Find a marker post for loading.
    var posts_count = posts.children().length

    // If we've already loaded more posts than those available on the
    // server, there's nothing left for us to do
    if (posts_count >= total_posts - 1) {
        return
    }

    var marker_post_index = posts_count > 12 ? posts_count - 12 : 0;
    var marker_post = posts.children().eq(marker_post_index)
    var marker_top = marker_post.offset().top
    var marker_bottom = marker_top + marker_post.outerHeight()

    // Check if the marker is in the viewport
    var viewport_top = $(window).scrollTop();
    var viewport_bottom = viewport_top + $(window).height();

    if (marker_bottom < viewport_bottom && !getting_posts) {
        getting_posts = true
        $.getJSON(POSTS_URL, {
            page: index,
            count: POSTS_PER_PAGE
        }, function(data) {
            add_posts(data.data)
            index++
            getting_posts = false
        })
    }
})
