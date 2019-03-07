
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


$('.modal-btn').on('click', function () {
    var $this = $(this);
    var url = $this.attr('href');
    var text = $this.text();
    var $modal = $('#modal');
    var $image = $modal.find('.modal-body');
    var $title = $modal.find('.modal-title');

    $image.html('<img src="'+url+'"/>');
    $title.text(text);
});  