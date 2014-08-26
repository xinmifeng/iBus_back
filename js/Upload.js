/**
 * Created by Administrator on 14-8-24.
 */
function ModelUpload() {
    var swfu;
    var settings = {
        flash_url: "../SWFUpload/swfupload/swfupload.swf",
        upload_url: "http://localhost/SWFUpload/upload.php",	// Relative to the SWF file
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "200 MB",
        file_types: "*.*",
        file_types_description: "All Files",
        file_upload_limit: 100,
        file_queue_limit: 0,
        custom_settings: {
            progressTarget: "fsUploadProgress",
            cancelButtonId: "btnCancel"
        },
        debug: false,
        type: ImageInfo,


        // Button settings
        button_image_url: "../SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
        button_width: "65",
        button_height: "29",
        button_placeholder_id: "spanButtonPlaceHolder",
        button_text: '<span class="theFont">‰Ø¿¿</span>',
        button_text_style: ".theFont { font-size: 16; }",
        button_text_left_padding: 12,
        button_text_top_padding: 3,

        // The event handler functions are defined in handlers.js
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        /// file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess,
        upload_complete_handler: uploadComplete,
        queue_complete_handler: queueComplete	// Queue plugin event
    };
    swfu = new SWFUpload(settings);
    return swfu;
}


function ModelUpload1() {
    var swfu;
    var settings = {
        flash_url: "../SWFUpload/swfupload/swfupload.swf",
        upload_url: "http://localhost/SWFUpload/upload.php",	// Relative to the SWF file
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "200 MB",
        file_types: "*.*",
        file_types_description: "All Files",
        file_upload_limit: 100,
        file_queue_limit: 0,
        custom_settings: {
            progressTarget: "fsUploadProgress1",
            cancelButtonId: "btnCancel"
        },
        debug: false,
        type: ImageDetails,

        // Button settings
        button_image_url: "../SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
        button_width: "65",
        button_height: "29",
        button_placeholder_id: "spanButtonPlaceHolder1",
        button_text: '<span class="theFont1">‰Ø¿¿</span>',
        button_text_style: ".theFont1 { font-size: 16; }",
        button_text_left_padding: 12,
        button_text_top_padding: 3,

        // The event handler functions are defined in handlers.js
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        /// file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess,
        upload_complete_handler: uploadComplete,
        queue_complete_handler: queueComplete	// Queue plugin event
    };
    swfu = new SWFUpload(settings);
    return swfu;
}


function ModelUpload2() {
    var swfu;
    var settings = {
        flash_url: "../SWFUpload/swfupload/swfupload.swf",
        upload_url: "http://localhost/SWFUpload/upload.php",	// Relative to the SWF file
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "200 MB",
        file_types: "*.*",
        file_types_description: "All Files",
        file_upload_limit: 100,
        file_queue_limit: 0,
        custom_settings: {
            progressTarget: "fsUploadProgress2",
            cancelButtonId: "btnCancel"
        },
        debug: false,
        type: apk_id,

        // Button settings
        button_image_url: "../SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
        button_width: "65",
        button_height: "29",
        button_placeholder_id: "spanButtonPlaceHolder2",
        button_text: '<span class="theFont2">‰Ø¿¿</span>',
        button_text_style: ".theFont2 { font-size: 16; }",
        button_text_left_padding: 12,
        button_text_top_padding: 3,

        // The event handler functions are defined in handlers.js
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        /// file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess,
        upload_complete_handler: uploadComplete,
        queue_complete_handler: queueComplete	// Queue plugin event
    };
    swfu = new SWFUpload(settings);
    return swfu;
}



function ModelUpload3() {
    var swfu;
    var settings = {
        flash_url: "../SWFUpload/swfupload/swfupload.swf",
        upload_url: "http://localhost/SWFUpload/upload.php",	// Relative to the SWF file
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "200 MB",
        file_types: "*.*",
        file_types_description: "All Files",
        file_upload_limit: 100,
        file_queue_limit: 0,
        custom_settings: {
            progressTarget: "fsUploadProgress5",
            cancelButtonId: "btnCancel"
        },
        debug: false,
        type: Video5_msg,


        // Button settings
        button_image_url: "../SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
        button_width: "65",
        button_height: "29",
        button_placeholder_id: "spanButtonPlaceHolder5",
        button_text: '<span class="theFont5">‰Ø¿¿</span>',
        button_text_style: ".theFont5 { font-size: 16; }",
        button_text_left_padding: 12,
        button_text_top_padding: 3,

        // The event handler functions are defined in handlers.js
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        /// file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess,
        upload_complete_handler: uploadComplete,
        queue_complete_handler: queueComplete	// Queue plugin event
    };
    swfu = new SWFUpload(settings);
    return swfu;
}


function ModelUpload4() {
    var swfu;
    var settings = {
        flash_url: "../SWFUpload/swfupload/swfupload.swf",
        upload_url: "http://localhost/SWFUpload/upload.php",	// Relative to the SWF file
        post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
        file_size_limit: "200 MB",
        file_types: "*.*",
        file_types_description: "All Files",
        file_upload_limit: 100,
        file_queue_limit: 0,
        custom_settings: {
            progressTarget: "fsUploadProgress4",
            cancelButtonId: "btnCancel"
        },
        debug: false,
        type: Video4_msg,


        // Button settings
        button_image_url: "../SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
        button_width: "65",
        button_height: "29",
        button_placeholder_id: "spanButtonPlaceHolder4",
        button_text: '<span class="theFont4">‰Ø¿¿</span>',
        button_text_style: ".theFont4 { font-size: 16; }",
        button_text_left_padding: 12,
        button_text_top_padding: 3,

        // The event handler functions are defined in handlers.js
        file_queued_handler: fileQueued,
        file_queue_error_handler: fileQueueError,
        /// file_dialog_complete_handler: fileDialogComplete,
        upload_start_handler: uploadStart,
        upload_progress_handler: uploadProgress,
        upload_error_handler: uploadError,
        upload_success_handler: uploadSuccess,
        upload_complete_handler: uploadComplete,
        queue_complete_handler: queueComplete	// Queue plugin event
    };
    swfu = new SWFUpload(settings);
    return swfu;
}






