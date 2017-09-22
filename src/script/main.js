var infiniteLoading = (function() {
    "use strict";

    var postsPerPage = 6;
    var currentPage = 1;
    var isPreviousEventComplete = true;
    var isDataAvailable = true;

    var getParameterByName = function(name, url) {
        if (!url)
            url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
        var results = regex.exec(url);
        if (!results)
            return null;
        if (!results[2])
            return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    };


var _readPosts = function(loadOnPageEnter) {
            if (isPreviousEventComplete && isDataAvailable) {
                isPreviousEventComplete = false;

                $.ajax({
                        type: 'POST',
                        url: 'src/procedures/load.php',
                        dataType: 'json',
                        data: {
                            startIndex: 	postsPerPage * (currentPage-1),
                            postsPerPage: 	postsPerPage
                        },

                        success: function (result) {
                            if (result.elements.length) {
                                for (var i = 0; i < result.elements.length; i++) {
                                    var mems = result.elements[i];
                                    //tworzymy template newsa
                                    var theTemplateScript = $("#mem-template").html();
                                    var theTemplate = Handlebars.compile(theTemplateScript);
                                    var context = {
                                            memid: mems.id,
                                            memautor:mems.autor,
                                            image: mems.image,
                                            postVote: mems.vote,
                                            userChoice: mems.userVote
                                    };

                                    var theCompiledHtml = theTemplate(context);
                                    var $element = $(theCompiledHtml);
                                    $(".mem-list .mem").append($element);
                                    // var voteUp=$("#vote-up-"+ mems.id);
                                    // var voteDown = ("#vote-down-"+ mems.id);
                                    // var voteNote = $("#vote-"+ mems.id);
                                    var voteUp = document.getElementById('vote-up-'+mems.id)
                                    var voteDown = document.getElementById('vote-down-'+mems.id)
                                    var voteNote = document.getElementById('vote-'+mems.id)
                                    var userId = mems.activeUser;
                                    console.log(voteUp,voteDown)
                                    $("#vote-up-"+ mems.id).click(function(){
                                        vote('up',
                                            userId,
                                            mems.id,
                                            voteNote,
                                            voteUp,
                                            voteDown
                                    )
                                    });
                                };
                            isPreviousEventComplete = true;  

                            if (!loadOnPageEnter) {
                                var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
                                history.pushState(null, $('head > title').html(), url + '?page=' + currentPage);
                                currentPage++;
                                
                            }
                        
                        
                        } else {
                            //wczytano puste dane - dane nie sa juz dostepne
                            isDataAvailable = false;
                        }
                        if (result.endList == true) {
                            isDataAvailable = false;
                        }
                    },

                        error: function (error) {
                            console.log("errorek")
                            console.log(error);
                        },

                        complete: function () {
                        }
                });
            }
    };
    var _displayPageOnPageEnter = function() {
		if (getParameterByName('page') != '' && getParameterByName('page') != null) {
			currentPage =  parseInt(getParameterByName('page'), 10);
			if (currentPage < 1) currentPage = 1;
		} else {
			currentPage = 1;
		}
		_readPosts();
	};

    var _displayPageOnScroll = function() {
        $(window).bind('mousewheel DOMMouseScroll scroll ',function () {
        if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
            _readPosts(false);
        }
        });
};

    var _init = function() {
            _displayPageOnPageEnter();
            _displayPageOnScroll();
    };

    return {
            init : _init
    }
})();

$(function() {
    infiniteLoading.init();
})
