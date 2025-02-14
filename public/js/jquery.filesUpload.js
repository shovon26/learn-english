(function($) {

    $.fn.fileUploader = function(filesToUpload, sectionIdentifier, fileIdCounter) {
        this.closest(".files").change(function(evt) {
            let output = [];

            for (let i = 0; i < evt.target.files.length; i++) {
                $('#attachmentError').text('');
                let filesize = Math.round(evt.target.files[i].size/1024);
                console.log(filesize);

                if (fileIdCounter < 3 && filesize <2024) {
                    fileIdCounter++;
                    let file = evt.target.files[i];
                    let fileId = sectionIdentifier + fileIdCounter;

                    filesToUpload.push({
                        id: fileId,
                        file: file
                    });

                    let removeLink = "<a class='removeFile color-blue' href='#' data-fileid='" + fileId + "'><q-icon class='trash-outline icon icon-size-1'></q-icon></a>";

                    output.push("<li><strong>", escape(file.name), "</strong> - ", formatBytes(file.size), " &nbsp; ", removeLink, "<br><span class='error error_attachments' id='error_attachments" + (fileIdCounter - 1) + "'></span></li> ");
                } 
                else if(filesize >=2024){
                    $('#attachmentError').text('File size must be less than 2MB.');
                }
                else {
                    $.confirm({
                        title: 'Alert!',
                        content: "You can't upload more than 3 files!",
                    });
                    break;
                }
            }

            $(this).children(".fileList")
                .append(output.join(""));

            //reset the input to null - nice little chrome bug!
            evt.target.value = null;
        });

        $(this).on("click", ".removeFile", function(e) {
            e.preventDefault();

            let fileId = $(this).parent().children("a").data("fileid");

            // loop through the files array and check if the name of that file matches FileName
            // and get the index of the match
            for (let i = 0; i < filesToUpload.length; ++i) {
                if (filesToUpload[i].id === fileId) {
                    filesToUpload.splice(i, 1);
                }
            }
            fileIdCounter--;

            $(this).parent().remove();

            let errorFields = $('.error_attachments');
            $.each(errorFields, function(key) {
                $(this).attr('id', 'error_attachments' + key);
            });
        });

        $(this).on("click", ".removeFileDirectly", function(e) {
            e.preventDefault();

            let actionField = $(this);
            let module = $(this).attr('url-data');
            let imageIndex = $(this).attr('data-imageindex');
            let id = $(this).attr('data-id');

            $.confirm({
                title: '<p class="text-danger mb-0">Delete!',
                content: 'Are you sure you want to delete this file?',
                buttons: {
                    confirm: function() {
                        let data = { 'id': id, 'imageIndex': imageIndex, '_token': $('meta[name="csrf-token"]').attr('content') };
                        fileIdCounter--;
                        actionField.parent().remove();

                        $.ajax({
                            url: '/' + module + '/attachment-update',
                            type: 'post',
                            dataType: "json",
                            data: data,
                            cache: false,
                            success: function() {
                                showSuccessMassage('Deleted successfully!');
                            },
                            error: function(request, status, error) {
                                showErrorMassage('Something went wrong!');
                            }
                        });
                    },
                    cancel: function() {}
                }
            });
        });

        this.clear = function() {
            for (let i = 0; i < filesToUpload.length; ++i) {
                if (filesToUpload[i].id.indexOf(sectionIdentifier) >= 0)
                    filesToUpload.splice(i, 1);
            }

            $(this).children(".fileList").empty();
        }

        return this;
    };

}(jQuery));