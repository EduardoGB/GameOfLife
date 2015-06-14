var JSONData    = "";
var height      = (jQuery(window).height()-100)/13;
var width       = jQuery(window).width()/13;
var data        = new Array();
var ids         = "";

jQuery(window).ready(function(){
    paintBoard();
    addClickToCeld();
});

function addClickToCeld(){
    jQuery('.field').click(function(){
        if(data.lastIndexOf(jQuery(this).attr('id')) >= 0){
            data.splice(data.lastIndexOf(jQuery(this).attr('id')), 1);
            jQuery(this).removeClass('active');
        } else {
            data.push(jQuery(this).attr('id'));
            jQuery(this).addClass('active');
        }
    });
}

function paintBoard(){
    for(var x = 0 ; x <= height ; x++ ){
        for(var y = 0 ; y <= width ; y++ ){
            var dclass = (y==0) ? 'inicio' : (y==width) ? 'final' : 'a';
            jQuery('.container').append('<div id="'+(y+'-'+x)+'" class="field '+ dclass +'"></div>');
        }
    }
}

function sendData(){
    var celds = (JSONData) ? {'celds' : JSONData } : null; 
    jQuery.ajax({
            method:"GET",
            async:false,
            url:"source/process.php",
            data:celds,
            success:function(response){
                setNewData(response)
            }
        });
}

function setNewData(response){
    var res = JSON.parse(response);
    ids = res.ids;
    JSONData = (!res.ids) ? data.toString() : null ;
    jQuery('.field').removeClass('active');
    jQuery(ids).addClass('active');
}

function initGame(){
    JSONData = data.toString();
    setInterval(sendData,1000);
}