$(document).ready(function () {

  var viewer = UstreamEmbed("UstreamFrame");

  $('.media').on("click", function (e) {
    clearFields();

    var target = $(e.currentTarget),
        media = target.data('media'),
        type = target.data('type');

    viewer.callMethod('load', type, media);

    e.preventDefault();
  });

  /*
   clear some data fields that are relevant to content
   */
  var clearFields = function () {

    $('.st-ended').hide();
    $('.st-playing').hide();
    $('.st-offline').hide();
    $('.st-live').hide();

  }

  /*
  event handler for events received from the embed iframe
  */
  var onEmbedEvent = function (event, data) {
    switch (event) {
      case "ready":
        clearFields();
        break;
      case "live":
        $('.st-live').show();
        $('.st-offline').hide();
        break;
      case "offline":
        $('.st-offline').show();
        $('.st-live').hide();
        break;
      case "playing":
        if (data) {
          $('.st-playing').show()
        } else {
          $('.st-playing').hide();
        }
        break;
      case "finished":
        $('.st-ended').show();
        break;
      case "content":
        $('.st-content').text(data.join(','));
        break;
      case "size":
        break;
    }
  }

  viewer.addListener('ready', onEmbedEvent);
  viewer.addListener('live', onEmbedEvent);
  viewer.addListener('offline', onEmbedEvent);
  viewer.addListener('playing', onEmbedEvent);
  viewer.addListener('finished', onEmbedEvent);
  viewer.addListener('size', onEmbedEvent);
  viewer.addListener('content', onEmbedEvent);

});
