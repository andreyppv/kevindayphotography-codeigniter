// Required for drag and drop file access
jQuery.event.props.push('dataTransfer');

// IIFE to prevent globals
(function() {

    var s;
    var Avatar = {

        settings: {
            bod: $("body"),
            img: $("#user-avatar-img"),
            fileInput: $("#user-avatar")
        },

        init: function() {
            s = Avatar.settings;
            Avatar.bindUIActions();
        },

        bindUIActions: function() {

            var timer;

            s.fileInput.on('change', function(event) {
                Avatar.handleDrop(event.target.files);
            });
        },

        showDroppableArea: function() {
            s.bod.addClass("droppable");
        },

        hideDroppableArea: function() {
            s.bod.removeClass("droppable");
        },

        handleDrop: function(files) {

            Avatar.hideDroppableArea();

            // Multiple files can be dropped. Lets only deal with the "first" one.
            var file = files[0];

            if (typeof file !== 'undefined' && file.type.match('image.*')) {

                Avatar.resizeImage(file, 112, function(data) {
                    Avatar.placeImage(data);
                });

            } else {

                alert("That file wasn't an image.");

            }

        },

        resizeImage: function(file, size, callback) {

            var fileTracker = new FileReader;
            fileTracker.onload = function() {
                Resample(
                    this.result,
                    size,
                    size,
                    callback
                );
            }
            fileTracker.readAsDataURL(file);

            fileTracker.onabort = function() {
                alert("The upload was aborted.");
            }
            fileTracker.onerror = function() {
                alert("An error occured while reading the file.");
            }

        },

        placeImage: function(data) {
            s.img.attr("src", data);
        }

    }

    Avatar.init();

})();