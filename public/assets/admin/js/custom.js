function checkCropSize(className,xId,yId,wId,hId,resHtml){
    xStart = $('#'+xId).val();
    yStart = $('#'+yId).val();
    width = $('#'+wId).val();
    height = $('#'+hId).val();
    imgSrc = $(className).attr('src');

    if(width && height){
        $('#progressbar').show();
        $.ajax({
            type: 'POST',
            url: '/index/imagesize',
            dataType: 'json',
            data: {x: xStart, y: yStart, w: width, h:height, imgStr:imgSrc},
            success: function(response) {
                //consolo.log(response);
                $('#'+resHtml).html('Size: '+ response.size+' KB').show();
                $('#progressbar').hide();
            }

        });

    }else{
        // $('#message-box-info .mb-content').html('<p>Nothing Cropped</p>');
        // $('#message-box-info').toggleClass("open");
        alert('Nothing Cropped');
    }

}
