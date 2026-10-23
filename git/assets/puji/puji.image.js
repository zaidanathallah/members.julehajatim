function resizeImage(url, callback){
	var canvas = document.createElement("canvas");
	var MAX_WIDTH_ALLOWED = 1600;
	var MAX_HEIGHT = 0;
	canvas.width = 1600;
	var img = new Image();
	img.onload = function(){
		MAX_HEIGHT = img.height * MAX_WIDTH_ALLOWED / img.width;
		canvas.height = MAX_HEIGHT;
		var ctx = canvas.getContext("2d");
		ctx.drawImage(img, 0, 0, MAX_WIDTH_ALLOWED, MAX_HEIGHT);
		callback(canvas.toDataURL("image/jpeg"));
	}
	img.src = url;
}
function resizeImage2(url,width, callback){
	var canvas = document.createElement("canvas");
	var MAX_WIDTH_ALLOWED = width;
	var MAX_HEIGHT = 0;
	canvas.width = width;
	var img = new Image();
	img.onload = function(){
		MAX_HEIGHT = img.height * MAX_WIDTH_ALLOWED / img.width;
		canvas.height = MAX_HEIGHT;
		var ctx = canvas.getContext("2d");
		ctx.drawImage(img, 0, 0, MAX_WIDTH_ALLOWED, MAX_HEIGHT);
		callback(canvas.toDataURL("image/jpeg"));
	}
	img.src = url;
}
function getBase64Image(img) {
    // Create an empty canvas element
    var canvas = document.createElement("canvas");
    console.log('width',img.width)
	console.log('height',img.height)
	canvas.width = img.width;
    canvas.height = img.height;

    // Copy the image contents to the canvas
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0,90,90);

    // Get the data-URL formatted image
    // Firefox supports PNG and JPEG. You could check img.src to
    // guess the original format, but be aware the using "image/jpg"
    // will re-encode the image.
    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}
logo = 'data:image/png;base64,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Ax1E0ra8SN3gRBC5WiyEmbWyuZl2R7MsMGO4susGEd0SQyMiI8PDEvfVwPKs9DsTrTHHQsMjIyNCEz2xvETCt712QKQ6CiwMInc4A9ypMqKbw2ZC/KPczPRb9Vn0sdtnBkZ+uTz6OLOyNCMjuzNJQksYI3w7ixPYdFEXAS2/msEGlJsPC3u7G4pEBYponrj2evDC8cIW+sil3FcDRSmGeO/vhUn7twtFd6gD7E/FvIuAQHCjNMCEPXMmm/5LVuy7grLa3rvJ18vif0ht++38ieKe+tKCEFFzV3MFuyfRLMjKosFiIFW6EwDCxZ2GKuHRtDWWKRdz8hktRemx/qEel/uu5Vw4tVFgfVTYamrLPaRose6mLgriupaGJCP7oQYDEi1mmxrR+/YQLDlQ++xp9wBSBxb7SwsFWrsr6daMuCAJKamEd1EQCKmXQHDZsMFC2c8rWBsvYnO0qP7561cv2m8m2K4CytTdHoIWtfA8cgkJV+wHi4PUOu2RpxYD9u4UszDbrGhO4heU19TX15TFiyjwATkXEn47A/ahudWSrrcEaEVhKlKTYA9MIInRUHwD1WuHO7+eGsF6taJipJUZuwRJE02Uccj6MYlzVjavGA1F1wakq9BknaQvpaJlw+O7yzFu8ybqblNDvHo8Aw1+tOITqowBS4E06JvQxpOZkB7neaqKLJeQ19Aiq8uJqdLO9aEl04gfOsOs23BJEM+Nk2iVwRU/WUWM9RanxwR4uAfsP32nd/IyGk5AfTAJZQJLgkBwmyrzILj+VtWEWHNrW2tjQ0Mj0rSg4+rfaUwXpeZ9YGmQeEkhkdnBCeAXMAFmrQHk8itkPwIC2vdrI4w1NDQolHULGIWCvPomrKpaH3wMBAhHa+mdSxq9LlEJfBwEWEU1dJc0DTFW8CmgL7L/g/7ZoL8AhKQDXOp0jYkAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjEtMTItMjhUMTQ6MjY6NDIrMDA6MDC2WW24AAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIxLTEyLTI4VDE0OjI2OjQyKzAwOjAwxwTVBAAAACB0RVh0c29mdHdhcmUAaHR0cHM6Ly9pbWFnZW1hZ2ljay5vcme8zx2dAAAAGHRFWHRUaHVtYjo6RG9jdW1lbnQ6OlBhZ2VzADGn/7svAAAAGHRFWHRUaHVtYjo6SW1hZ2U6OkhlaWdodAAxOTJAXXFVAAAAF3RFWHRUaHVtYjo6SW1hZ2U6OldpZHRoADE5MtOsIQgAAAAZdEVYdFRodW1iOjpNaW1ldHlwZQBpbWFnZS9wbmc/slZOAAAAF3RFWHRUaHVtYjo6TVRpbWUAMTY0MDcwMTYwMsl/O9oAAAAPdEVYdFRodW1iOjpTaXplADBCQpSiPuwAAABWdEVYdFRodW1iOjpVUkkAZmlsZTovLy9tbnRsb2cvZmF2aWNvbnMvMjAyMS0xMi0yOC81NTkzYmE5NjU3OTZhMzVhYTE2YTliMjZjNDExNTY0OS5pY28ucG5nZVoJMgAAAABJRU5ErkJggg==';
