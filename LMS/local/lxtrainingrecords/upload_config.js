$(function () {
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   *
   * UI functions ui_* can be located in: upload-ui.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
    url: 'upload_files.php',
    maxFileSize: 10000000, // 10 Megs
    onDragEnter: function () {
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    onDragLeave: function () {
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function () {
      // Plugin is ready to use
      ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function () {
      // All files in the queue are processed (success or error)
      ui_add_log('All pending tranfers finished');
    },
    onNewFile: function (id, file) {
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function (id) {
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      ui_multi_update_file_progress(id, 0, '', true);

      // $('body').addClass('preloader-site');

    },
    onUploadCanceled: function (id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Canceled by User');
      ui_multi_update_file_progress(id, 0, 'warning', false);
    },
    onUploadProgress: function (id, percent) {
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function (id, data) {
      // A file was successfully uploaded
      ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
      ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
      ui_multi_update_file_status(id, 'success', 'Upload Complete');
      ui_multi_update_file_progress(id, 100, 'success', false);

      // preloading
      // $('.preloader-wrapper').fadeOut();
      // $('body').removeClass('preloader-site');

      Swal.fire({
        title: 'Load data success',
        width: 350,
        icon: 'success',
        showCloseButton: false,
        showConfirmButton: false,
        timer: 1500

      }).then((result) => {
        if (!result.value) {
          location.reload();
          console.log("exit");
        }
      });


    },
    onUploadError: function (id, xhr, status, message) {
      ui_multi_update_file_status(id, 'danger', message);
      //console.log(message);
      ui_multi_update_file_progress(id, 0, 'danger', false);

      if (message = "Internal Server Error") {
        ui_multi_update_file_progress(id, 100, 'success', false);
        ui_multi_update_file_status(id, 'success', 'Upload Complete');


        Swal.fire({
          title: 'Invalid data',
          text: 'Please check your data',
          width: 350,
          icon: 'error',
          showCloseButton: false,
          showConfirmButton: false,
          timer: 1500

        }).then((result) => {
          if (!result.value) {
            location.reload();
            console.log("exit");
          }
        });



      }

    },
    onFallbackMode: function () {
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function (file) {
      ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
  });
});
