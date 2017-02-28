function mainmenu(){
$(" #nav ul ").css({display: "none"}); // Opera Fix
$(" #nav li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
}

$(function(){
    $(".mitem").click(function(){
        $("#nav ul").hide();
    });
});
 
 
 $(document).ready(function(){					
	mainmenu();
});

function ResizeIframe(iframe) {
    var iframeBody = (iframe.contentDocument) ? iframe.contentDocument.body : iframe.contentWindow.document.body; 
    var height = (iframeBody.scrollHeight < iframeBody.offsetHeight) ? iframeBody.scrollHeight : iframeBody.offsetHeight;
    height = height + 10;
    $(iframe).height(height);
}
