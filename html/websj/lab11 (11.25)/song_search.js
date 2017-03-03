document.observe("dom:loaded", function() {
    $("b_xml").observe("click", function(){
        //construct a Prototype Ajax.request object
        var rank=$("top").value;
        new Ajax.Request("songs_xml.php",{
            method:"get",
            parameters:{top:rank},
            onSuccess: showSongs_XML,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
    });
    $("b_json").observe("click", function(){
        //construct a Prototype Ajax.request object
        var rank=$("top").value;
        new Ajax.Request("songs_json.php",{
            method:"get",
            parameters:{top:rank},
            onSuccess: showSongs_JSON,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
    });
});

function showSongs_XML(ajax) {
    var oll=$("songs");
    while(oll.hasChildNodes()){
        oll.removeChild(oll.firstChild);
    }
    var songs=ajax.responseXML.getElementsByTagName("song");
    for(var i=0;i<songs.length;i++){
        var li=document.createElement("li");
        var title=songs[i].getElementsByTagName("title")[0].innerHTML;
        var artist=songs[i].getElementsByTagName("artist")[0].innerHTML;
        var genre=songs[i].getElementsByTagName("genre")[0].innerHTML;
        var time=songs[i].getElementsByTagName("time")[0].innerHTML;
        li.innerHTML=title+" - "+artist+ " ["+genre+"] ("+time+")";
        $("songs").appendChild(li);
    }
    //alert(ajax.responseText);
}

function showSongs_JSON(ajax) {
    var oll=$("songs");
    while(oll.hasChildNodes()){
        oll.removeChild(oll.firstChild);
    }
    var songs = JSON.parse(ajax.responseText);
    for(var i=0;i<songs.songs.length;i++){
        var li=document.createElement("li");
        var title=songs.songs[i].title;
        var artist=songs.songs[i].artist;
        var genre=songs.songs[i].genre;
        var time=songs.songs[i].time;
        li.innerHTML=title+" - "+artist+ " ["+genre+"] ("+time+")";
        $("songs").appendChild(li);
    }
    //alert(ajax.responseText);
    
}

function ajaxFailed(ajax, exception) {
    var errorMessage = "Error making Ajax request:\n\n";
    if (exception) {
        errorMessage += "Exception: " + exception.message;
    } else {
        errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
                        "\n\nServer response text:\n" + ajax.responseText;
    }
    alert(errorMessage);
}
