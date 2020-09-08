function selectFile() {
    var fileName = $('#file')[0].files[0]['name'];
    $("#fileLabel").text(fileName);
    $("#fileLabel").removeClass("btn btn-warning").addClass("btn btn-success");
}

function handleUpload(controller, id, type) {
	if($('#file').get(0).files.length === 0){
		alert('Please select a file.');
		return;
	}
    $('body').append('<div class="attachmentBG"><div class="loadSpinner"></div><div id="uploadText" class="loadText">Please Wait</div></div>');
    var files = $(`#file`)[0].files[0];

    var fd = new FormData();
    var old_file = files['name'].split('.');
    var newFileName = controller + '-' + id + '-';
    exstension = old_file.pop().toLowerCase();
    fd.append('id', id);
    fd.append('type', type);
    fd.append('description', files['name']);
    fd.append('ext', '.' + exstension);

    if (['jpg', 'jpeg', 'png'].includes(exstension)) {
        $("#uploadText").text('Compressing...');
        compress(files, function(result) {
            fd.append('file', result, newFileName);
            console.log('appended')
            pushUpload(fd);
        });
        //FOR RESOLUTION ALSO
        /*reduceFileSize(files, 500 * 1024, 1000, Infinity, 0.4, blob => {
            fd.append('file', blob, newFileName);
            pushUpload(fd);
        });*/
    } else {
        fd.append('file', files, newFileName);
        pushUpload(fd);
    }

}

function pushUpload(fd) {
    $("#uploadText").text('Uploading...');
    $.ajax({
        url: '/attachments/upload',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log('uploaded')
            location.reload();
        },
    });
}

function compress(file, callback) {
    var reader = new FileReader();

    reader.readAsDataURL(file);


    blob = reader.onloadend = function(e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function(ev) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function(ev) {
            	var canvas = document.createElement('canvas');
                canvas.width = image.width;
                canvas.height = image.height;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(image, 0, 0);
                var dataURL = canvas.toDataURL('image/jpeg', 0.3);
                var blob = dataURItoBlob(dataURL);
                callback(blob);
            }
        }
    }




    function dataURItoBlob(dataURI) {
        // convert base64/URLEncoded data component to raw binary data held in a string
        var byteString;
        if (dataURI.split(',')[0].indexOf('base64') >= 0)
            byteString = atob(dataURI.split(',')[1]);
        else
            byteString = unescape(dataURI.split(',')[1]);

        // separate out the mime component
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

        // write the bytes of the string to a typed array
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        return new Blob([ia], { type: mimeString });
    }




    /*var fd = new FormData(document.forms[0]);
    fd.append("file", blob, id);
    fd.append('ext', '.jpg');*/

}


//HANDLES RESOLUTION

/*
// From https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/toBlob, needed for Safari:
if (!HTMLCanvasElement.prototype.toBlob) {
    Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
        value: function(callback, type, quality) {

            var binStr = atob(this.toDataURL(type, quality).split(',')[1]),
                len = binStr.length,
                arr = new Uint8Array(len);

            for (var i = 0; i < len; i++) {
                arr[i] = binStr.charCodeAt(i);
            }

            callback(new Blob([arr], {type: type || 'image/png'}));
        }
    });
}

window.URL = window.URL || window.webkitURL;

// Modified from https://stackoverflow.com/a/32490603, cc by-sa 3.0
// -2 = not jpeg, -1 = no data, 1..8 = orientations
function getExifOrientation(file, callback) {
    // Suggestion from http://code.flickr.net/2012/06/01/parsing-exif-client-side-using-javascript-2/:
    if (file.slice) {
        file = file.slice(0, 131072);
    } else if (file.webkitSlice) {
        file = file.webkitSlice(0, 131072);
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var view = new DataView(e.target.result);
        if (view.getUint16(0, false) != 0xFFD8) {
            callback(-2);
            return;
        }
        var length = view.byteLength, offset = 2;
        while (offset < length) {
            var marker = view.getUint16(offset, false);
            offset += 2;
            if (marker == 0xFFE1) {
                if (view.getUint32(offset += 2, false) != 0x45786966) {
                    callback(-1);
                    return;
                }
                var little = view.getUint16(offset += 6, false) == 0x4949;
                offset += view.getUint32(offset + 4, little);
                var tags = view.getUint16(offset, little);
                offset += 2;
                for (var i = 0; i < tags; i++)
                    if (view.getUint16(offset + (i * 12), little) == 0x0112) {
                        callback(view.getUint16(offset + (i * 12) + 8, little));
                        return;
                    }
            }
            else if ((marker & 0xFF00) != 0xFF00) break;
            else offset += view.getUint16(offset, false);
        }
        callback(-1);
    };
    reader.readAsArrayBuffer(file);
}

// Derived from https://stackoverflow.com/a/40867559, cc by-sa
function imgToCanvasWithOrientation(img, rawWidth, rawHeight, orientation) {
    var canvas = document.createElement('canvas');
    if (orientation > 4) {
        canvas.width = rawHeight;
        canvas.height = rawWidth;
    } else {
        canvas.width = rawWidth;
        canvas.height = rawHeight;
    }

    if (orientation > 1) {
        console.log("EXIF orientation = " + orientation + ", rotating picture");
    }

    var ctx = canvas.getContext('2d');
    switch (orientation) {
        case 2: ctx.transform(-1, 0, 0, 1, rawWidth, 0); break;
        case 3: ctx.transform(-1, 0, 0, -1, rawWidth, rawHeight); break;
        case 4: ctx.transform(1, 0, 0, -1, 0, rawHeight); break;
        case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
        case 6: ctx.transform(0, 1, -1, 0, rawHeight, 0); break;
        case 7: ctx.transform(0, -1, -1, 0, rawHeight, rawWidth); break;
        case 8: ctx.transform(0, -1, 1, 0, 0, rawWidth); break;
    }
    ctx.drawImage(img, 0, 0, rawWidth, rawHeight);
    return canvas;
}

function reduceFileSize(file, acceptFileSize, maxWidth, maxHeight, quality, callback) {
    if (file.size <= acceptFileSize) {
        callback(file);
        return;
    }
    var img = new Image();
    img.onerror = function() {
        URL.revokeObjectURL(this.src);
        callback(file);
    };
    img.onload = function() {
        URL.revokeObjectURL(this.src);
        getExifOrientation(file, function(orientation) {
            var w = img.width, h = img.height;
            var scale = (orientation > 4 ?
                Math.min(maxHeight / w, maxWidth / h, 1) :
                Math.min(maxWidth / w, maxHeight / h, 1));
            h = Math.round(h * scale);
            w = Math.round(w * scale);

            var canvas = imgToCanvasWithOrientation(img, w, h, orientation);
            canvas.toBlob(function(blob) {
                console.log("Resized image to " + w + "x" + h + ", " + (blob.size >> 10) + "kB");
                callback(blob);
            }, 'image/jpeg', quality);
        });
    };
    img.src = URL.createObjectURL(file);
}*/