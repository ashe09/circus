//hamburger
$(function () {
  $("#hamburger").click(onOff);
    function onOff () {
      $("body").toggleClass("openNav");
      
      if ($(this).attr("aria-expanded") == "false") {
        $(this).attr("aria-expanded", true);
        $(".menu").text("CLOSE");
      } else {
        $(this).attr("aria-expanded", false);
        $(".menu").text("MENU");
      }
    }

//scroll
  $("a[href^='#']").click(scroll);
  function scroll() {
    var target = $(this).attr("href");
    var targetPos = $(target).offset().top;
    $("html,body").animate({"scrollTop":targetPos},500);
    return false;
  }
  
  $(".header a[href]").on("click", function(event) {
    $(".hamburger").trigger("click");
  });

//topPage arrow
  $(window).scroll(function(){
		if($(this).scrollTop() >300) {
			$("#pageTop").fadeIn();
		}else{
			$("#pageTop").fadeOut();
		}
  });

//scroll section animation
function showSectionAnimation() {
  var element = document.getElementsByTagName('section');
  if(!element) return;
  
  var showTiming = window.innerHeight > 768 ? 200 : 40;
  var scrollY = window.pageYOffset;
  var windowH = window.innerHeight;

  for(var i=0;i<element.length;i++) { var elemClientRect = element[i].getBoundingClientRect(); var elemY = scrollY + elemClientRect.top; if(scrollY + windowH - showTiming > elemY) {
      element[i].classList.add('inview');
    }
  }
}
showSectionAnimation();
window.addEventListener('scroll', showSectionAnimation);

//scroll img animation
function showElementAnimation() {
  var element = document.getElementsByClassName('giftImg');
  if(!element) return;
  
  var showTiming = window.innerHeight > 768 ? 200 : 40;
  var scrollY = window.pageYOffset;
  var windowH = window.innerHeight;

  for(var i=0;i<element.length;i++) { var elemClientRect = element[i].getBoundingClientRect(); var elemY = scrollY + elemClientRect.top; if(scrollY + windowH - showTiming > elemY) {
      element[i].classList.add('show');
    }
  }
}
showElementAnimation();
window.addEventListener('scroll', showElementAnimation);

//login modal
  $(".lsButtons.l").click(function() {
		var width = $(window).width();
		var modalWidth = $(".modal").outerWidth();
		var scrollWidth = $(window).scrollLeft();
		var position = (scrollWidth + (width - modalWidth) / 2) + "px";
		$(".modal").css("left", position);
    $(".blackBack").show();
    $(".modal").show();
  });

  $(".close").click(function() {
    $(".blackBack").hide();
    $(".modal").hide();
  });

  $(".blackBack").click(function() {
    $(this).hide();
    $(".modal").hide();
  });

//gifts modal
	$("#giftItem01").click(function() {
		var height = $(window).height();
		var modalHeight = $("#giftsmodal01").outerHeight();
		var scrollHeight = $(window).scrollTop();
		var position = (scrollHeight + (height - modalHeight) / 2) + "px";
		$("#giftsmodal01").css("top", position);
		$(".blackBack").show();
		$("#giftsmodal01").fadeIn(500);
	});

	$(".close").click(function() {
		$(".blackBack").fadeOut(400);
		$("#giftsmodal01").fadeOut(300);
	});

	$(".blackBack").click(function() {
		$(this).fadeOut(400);
		$("#giftsmodal01").fadeOut(300);
  });
  
	$("#giftItem04").click(function() {
		var height = $(window).height();
		var modalHeight = $("#giftsmodal04").outerHeight();
		var scrollHeight = $(window).scrollTop();
		var position = (scrollHeight + (height - modalHeight) / 2) + "px";
		$("#giftsmodal04").css("top", position);
		$(".blackBack").show();
		$("#giftsmodal04").fadeIn(500);
	});

	$(".close").click(function() {
		$(".blackBack").fadeOut(400);
		$("#giftsmodal04").fadeOut(300);
	});

	$(".blackBack").click(function() {
		$(this).fadeOut(400);
		$("#giftsmodal04").fadeOut(300);
  });

	//projects modal
	$("#projectItem01").click(function() {
		var height = $(window).height();
		var modalHeight = $("#projectsmodal01").outerHeight();
		var scrollHeight = $(window).scrollTop();
		var position = (scrollHeight + (height - modalHeight) / 2) + "px";
		$("#projectsmodal01").css("top", position);
		$(".blackBack").show();
		$("#projectsmodal01").fadeIn(500);
	});

	$(".close").click(function() {
		$(".blackBack").fadeOut(400);
		$("#projectsmodal01").fadeOut(300);
	});

	$(".blackBack").click(function() {
		$(this).fadeOut(400);
		$("#projectsmodal01").fadeOut(300);
  });
  
	$("#projectItem05").click(function() {
		var height = $(window).height();
		var modalHeight = $("#projectsmodal05").outerHeight();
		var scrollHeight = $(window).scrollTop();
		var position = (scrollHeight + (height - modalHeight) / 2) + "px";
		$("#projectsmodal05").css("top", position);
		$(".blackBack").show();
		$("#projectsmodal05").fadeIn(500);
	});

	$(".close").click(function() {
		$(".blackBack").fadeOut(400);
		$("#projectsmodal05").fadeOut(300);
	});

	$(".blackBack").click(function() {
		$(this).fadeOut(400);
		$("#projectsmodal05").fadeOut(300);
  });
	
//category menu
$(".categorySelect01").click(function() {
  $(".categoryAreaBack, .cmenu").addClass("opencNav");
});

$(".categorySelect02").click(function() {
	$(".categoryAreaBack, .cmenu").addClass("opencNav");
});

$(".categoryClose").click(function() {
	$(".categoryAreaBack, .cmenu").removeClass("opencNav");
});
	
$(".categoryAreaBack").click(function() {
	$(this).removeClass("opencNav");
	$(".cmenu").removeClass("opencNav");
});

//admin menu
$(".adminmenuSelect").click(function() {
  $(".categoryAreaBack, .cmenu").addClass("opencNav");
});

//keyImg slide
var img = 0;
var lastImg = parseInt($(".keyVwrapImg img").length-1);

$(".keyVwrapImg img").css("overflow","none");
$(".keyVwrapImg img").eq(img).css("display","block");

function changekyeImg(){
  $(".keyVwrapImg img").fadeOut(500);
  $(".keyVwrapImg img").eq(img).fadeIn(2000);
}

var Time;
function start(){
  Time =setInterval(function(){
    if(img === lastImg){
      img = 0;
      changekyeImg();
    }else{
      img ++;
      changekyeImg();
    }
  },5000);
}

start();

//gifts photo slide
  var page = 0;
  var lastPage = parseInt($("#slideImg img").length-1);

  $("#slideImg img").css("overflow","none");
  $("#slideImg img").eq(page).css("display","block");

  function changePage(){
    $("#slideImg img").fadeOut(500);
    $("#slideImg img").eq(page).fadeIn(2000);
  }

  var Timer;
  function startTimer(){
    Timer =setInterval(function(){
      if(page === lastPage){
        page = 0;
        changePage();
      }else{
        page ++;
        changePage();
      }
    },5000);
  }

  function stopTimer(){
  clearInterval(Timer);
  }

  startTimer();

  function changePage300(){
    $("#slideImg img").css({opacity:0.2}).fadeOut(300);
    $("#slideImg img").eq(page).css({opacity:1}).fadeIn(300);
  }

  $("#next").click(function() {
    stopTimer();
    startTimer();
      if(page === lastPage){
        page = 0;
        changePage300();
      }else{
        page ++;
        changePage300();
      }
    });

    $("#prev").click(function() {
      stopTimer();
      startTimer();
      if(page === 0){
        page = lastPage;
        changePage300();
      }else{
        page --;
        changePage300();
      }
    });

//photo upload
  $(".photoUpload").on("change", function () {
    var file = $(this).prop('files')[0];
    $(".photoName").text(file.name);
    $(".photoClear").show();
  });
  
  $(".photoClear").click(function() {
    $(".photoUpload").val("");
    $(".photoName").text("選択されていません。");
    $(this).hide();
  });

  //eventApp select
  $("#eventTitle").change(function() {
    var select = $("#eventTitle").val();
    if(select == "選択してください") {
      $('.select01').css('display', 'none');
      $('.select02').css('display', 'none');
    }
    if(select == "Luminaカラーグレーディング講座") {
      $('.select01').css('display', 'block');
      $('.select02').css('display', 'none');
    }else if(select == "アーティストのためのブランディングセミナー") {
      $('.select01').css('display', 'none');
      $('.select02').css('display', 'block');
    }
  });

  $(".radio").change(function() {
    var radio = $(".radio").val();
    if(radio == "9月9日 (水)") {
      $('.select01').css('display', 'block');
      $('.select02').css('display', 'none');
    }else if(radio == "9月25日 (金)") {
      $('.select01').css('display', 'none');
      $('.select02').css('display', 'block');
    }
  });

  //mypage
  $(".modify").click(function() {
    $(this).addClass("orange").removeClass("beige");
    $(".registerG").addClass("beige").removeClass("orange");
    $(".registerP").addClass("beige").removeClass("orange");
    $(".registerGArea").css("display","none");
    $(".registerPArea").css("display","none");
    $(".modifyArea").css("display","block");
  });

  $(".registerG").click(function() {
    $(this).addClass("orange").removeClass("beige");
    $(".modify").addClass("beige").removeClass("orange");
    $(".registerP").addClass("beige").removeClass("orange");
    $(".modifyArea").css("display","none");
    $(".registerPArea").css("display","none");
    $(".registerGArea").css("display","block");
  });

  $(".registerP").click(function() {
    $(this).addClass("orange").removeClass("beige");
    $(".modify").addClass("beige").removeClass("orange");
    $(".registerG").addClass("beige").removeClass("orange");
    $(".modifyArea").css("display","none");
    $(".registerGArea").css("display","none");
    $(".registerPArea").css("display","block");
  });
	
	//mypage560
	$(".mypageSelect").click(function() {
    $(".mypageMenu560").addClass("opencNav");
  });
	
	$(".categoryClose").click(function() {
    $(".mypageMenu560").removeClass("opencNav");
  });
	
	$(".mypageMenu560").click(function() {
    $(this).removeClass("opencNav");
  });
	
	$(".modify560").click(function() {
    $(".registerGArea").css("display","none");
    $(".registerPArea").css("display","none");
    $(".modifyArea").css("display","block");
  });
	
	$(".registerG560").click(function() {
    $(".modifyArea").css("display","none");
    $(".registerPArea").css("display","none");
    $(".registerGArea").css("display","block");
  });

	$(".registerP560").click(function() {
    $(".modifyArea").css("display","none");
    $(".registerGArea").css("display","none");
    $(".registerPArea").css("display","block");
  });
	
	//adminCategoryMenu
  $(".addCategory").click(function() {
    $(this).addClass("orange");
    $(".deleteCategory").removeClass("orange");
    $("#categoryGDelete").css("display","none");
    $("#categoryPDelete").css("display","none");
    $("#categoryAddArea").css("display","block");
  });

  $(".deleteCategory").click(function() {
    $(this).addClass("orange");
    $(".addCategory").removeClass("orange");
		$("#categoryAddArea").css("display","none");
    $("#categoryGDelete").css("display","flex");
    $("#categoryPDelete").css("display","flex");
  });

});

