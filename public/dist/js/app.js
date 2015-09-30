"use strict";function _init(e){$.ItwayIO.notifier={activate:function(){var e=this;e.newPostCreated(),e.removeNotifiedState()},newPostCreated:function(){var t=this;e.socket.on("post-created:itway\\Events\\PostWasCreatedEvent",function(o){e.notifyBlock.prepend('<div class="control-sidebar-heading">New Post added</div> <li><span class="has-notify"></span><a class="message-link" href="'+e.host+"/"+o.post.locale+"/blog/post/"+o.post.id+'"> <p class="message-title">'+o.post.title+'</p> <small class="notifier-info text-center" >'+o.post.preamble+'<div class="clearfix"></div><img class="avatar" src="'+e.host+"/images/users/"+o.user.photo+'" alt=""></img> <span class="author">'+o.user.name+"</span> </small></a></li>"),e.notifyBlock.data("data-new","present"),t.addNotifiedState()})},addNotifiedState:function(){e.notifyBtn.prepend('<span class="has-notify"></span>')},removeNotifiedState:function(){e.notifyBtn.bind("click",function(){$(this).find("span.has-notify").length>0&&$(this).find("span.has-notify").remove()})}};var t;$.ItwayIO.search={activate:function(){var e=this;$("#search button").click(function(t){t.preventDefault(),e.search()}),$(".tag-search").on("click",function(t){t.preventDefault(),e.tagSearch()}),$('a[href="#search"]').on("click",function(e){e.preventDefault(),$("#search").addClass("open"),$('#search > form > input[type="search"]').focus(),$("body").css({overflow:"hidden"})}),$("#search, #search button.close").on("click keyup",function(e){(e.target==this||"close"==e.target.className||27==e.keyCode)&&($(this).removeClass("open"),$("body").css({overflow:"auto"}))}),$("#search form").submit(function(e){return e.preventDefault(),!1}),$('#search > form > input[type="search"]').keyup(function(t){13==t.keyCode&&$("#search .search-input").val().length>0||$("#search .search-input").val().length>0?e.search():e.stopSearch()})},search:function(){var e=this;t=setTimeout(function(){$.ajax({url:"http://www.itway.io/search",data:{keywords:$("#search .search-input").val()},method:"post",success:function(e){$(".search-result").html(e)},error:function(t){$(".search-result").html('<h3 class="text-danger"> Error occured </h3>'),console.log(t.type),e.stopSearch()}})},500)},tagSearch:function(){var e=this;t=setTimeout(function(){$.ajax({url:"http://www.itway.io/getAllExistingTags",method:"post",success:function(e){$(".search-result").html(e)},error:function(t){$(".search-result").html('<h3 class="text-danger"> Error occured </h3>'),console.log(t.type),e.stopSearch()}})},500)},stopSearch:function(){clearTimeout(t)}},$.ItwayIO.layout={activate:function(){var e=this;e.fix(),e.fixSidebar(),$(window,".container.wrapper").resize(function(){e.fix(),e.fixSidebar()})},fix:function(){var e=$("#navigation").outerHeight()+$("#footer").outerHeight(),t=$(window).height(),o=$(".sidebar").height();if($("body").hasClass("fixed"))$(".content-wrapper, .right-side").css("min-height",t-$("#footer").outerHeight());else{var i;t>=o?($(".content-wrapper, .right-side").css("min-height",t-e),i=t-e):($(".content-wrapper, .right-side").css("min-height",o),i=o);var a=$($.ItwayIO.options.controlSidebarOptions.selector);"undefined"!=typeof a&&a.height()>i&&$(".content-wrapper, .right-side").css("min-height",a.height())}},fixSidebar:function(){return $("body").hasClass("fixed")?("undefined"==typeof $.fn.slimScroll&&console&&console.error("Error: the fixed layout requires the slimscroll plugin!"),void($.ItwayIO.options.sidebarSlimScroll&&"undefined"!=typeof $.fn.slimScroll&&($(".sidebar").slimScroll({destroy:!0}).height("auto"),$(".sidebar").slimscroll({height:$(window).height()-$("#navigation").height()+"px",color:"rgba(0,0,0,0.2)",size:"3px"})))):void("undefined"!=typeof $.fn.slimScroll&&$(".sidebar").slimScroll({destroy:!0}).height("auto"))}},$.ItwayIO.pushMenu={activate:function(e){var t=$.ItwayIO.options.screenSizes;$(e).on("click",function(e){e.preventDefault(),$(window).width()>t.sm-1?$("body").toggleClass("sidebar-collapse"):$("body").hasClass("sidebar-open")?($("body").removeClass("sidebar-open"),$("body").removeClass("sidebar-collapse")):$("body").addClass("sidebar-open")}),$(".content-wrapper").click(function(){$(window).width()<=t.sm-1&&$("body").hasClass("sidebar-open")&&$("body").removeClass("sidebar-open")}),($.ItwayIO.options.sidebarExpandOnHover||$("body").hasClass("fixed")&&$("body").hasClass("sidebar-mini"))&&this.expandOnHover()},expandOnHover:function(){var e=this,t=$.ItwayIO.options.screenSizes.sm-1;$(".main-sidebar").hover(function(){$("body").hasClass("sidebar-mini")&&$("body").hasClass("sidebar-collapse")&&$(window).width()>t&&e.expand()},function(){$("body").hasClass("sidebar-mini")&&$("body").hasClass("sidebar-expanded-on-hover")&&$(window).width()>t&&e.collapse()})},expand:function(){$("body").removeClass("sidebar-collapse").addClass("sidebar-expanded-on-hover")},collapse:function(){$("body").hasClass("sidebar-expanded-on-hover")&&$("body").removeClass("sidebar-expanded-on-hover").addClass("sidebar-collapse")}},$.ItwayIO.tree=function(e){var t=this;$("li a",$(e)).on("click",function(e){var o=$(this),i=o.next();if(i.is(".treeview-menu")&&i.is(":visible"))i.slideUp("normal",function(){i.removeClass("menu-open")}),i.parent("li").removeClass("active");else if(i.is(".treeview-menu")&&!i.is(":visible")){var a=o.parents("ul").first(),s=a.find("ul:visible").slideUp("normal");s.removeClass("menu-open");var n=o.parent("li");i.slideDown("normal",function(){i.addClass("menu-open"),a.find("li.active").removeClass("active"),n.addClass("active"),t.layout.fix()})}i.is(".treeview-menu")&&e.preventDefault()})},$.ItwayIO.controlSidebar={activate:function(){var e=this,t=$.ItwayIO.options.controlSidebarOptions,o=$(t.selector),i=$(t.toggleBtnSelector);i.on("click",function(i){i.preventDefault(),o.hasClass("control-sidebar-open")||$("body").hasClass("control-sidebar-open")?(e.close(o,t.slide),$(this).removeClass("active")):(e.open(o,t.slide),$(this).addClass("active"))});var a=$(".control-sidebar-bg");e._fix(a),$("body").hasClass("fixed")?e._fixForFixed(o):$(".content-wrapper, .right-side").height()<o.height()&&e._fixForContent(o)},open:function(e,t){t?e.addClass("control-sidebar-open"):$("body").addClass("control-sidebar-open")},close:function(e,t){t?e.removeClass("control-sidebar-open"):$("body").removeClass("control-sidebar-open")},_fix:function(e){var t=this,o=$("#navigation").outerHeight();$("body").hasClass("layout-boxed")?(e.css("position","absolute"),e.height($(window).height()/2-o).css({"overflow-y":"auto"}),$(window).resize(function(){t._fix(e)})):e.css({position:"fixed",height:"auto"})},_fixForFixed:function(e){e.css({position:"fixed","max-height":"100%",overflow:"auto","padding-bottom":"50px"})},_fixForContent:function(e){$(".content-wrapper, .right-side").css("min-height",e.height())}},$.ItwayIO.boxWidget={selectors:$.ItwayIO.options.boxWidgetOptions.boxWidgetSelectors,icons:$.ItwayIO.options.boxWidgetOptions.boxWidgetIcons,activate:function(){var e=this;$(e.selectors.collapse).on("click",function(t){t.preventDefault(),e.collapse($(this))}),$(e.selectors.remove).on("click",function(t){t.preventDefault(),e.remove($(this))})},collapse:function(e){var t=this,o=e.parents(".box").first(),i=o.find("> .box-body, > .box-footer");o.hasClass("collapsed-box")?(e.children(":first").removeClass(t.icons.open).addClass(t.icons.collapse),i.slideDown(300,function(){o.removeClass("collapsed-box")})):(e.children(":first").removeClass(t.icons.collapse).addClass(t.icons.open),i.slideUp(300,function(){o.addClass("collapsed-box")}))},remove:function(e){var t=e.parents(".box").first();t.slideUp()}}}if("undefined"==typeof jQuery)throw new Error("ItwayIO requires jQuery");$.ItwayIO={},$.ItwayIO.options={host:"http://"+window.location.hostname,socket:io("http://www.itway.io:6378"),notifyBlock:$(".notify"),notifyBtn:$(".button-notify"),navbarMenuSlimscroll:!0,navbarMenuSlimscrollWidth:"3px",navbarMenuHeight:"200px",sidebarControlWidth:"280px",sidebarToggleSelector:"[data-toggle='offcanvas']",sidebarPushMenu:!0,sidebarSlimScroll:!0,sidebarExpandOnHover:!1,enableBoxRefresh:!0,enableBSToppltip:!0,BSTooltipSelector:"[data-toggle='tooltip']",enableFastclick:!0,enableControlSidebar:!0,controlSidebarOptions:{toggleBtnSelector:"[data-toggle='control-sidebar']",selector:".control-sidebar",slide:!0},enableBoxWidget:!0,boxWidgetOptions:{boxWidgetIcons:{collapse:"fa-minus",open:"fa-plus",remove:"fa-times"},boxWidgetSelectors:{remove:'[data-widget="remove"]',collapse:'[data-widget="collapse"]'}},directChat:{enable:!0,contactToggleSelector:'[data-widget="chat-pane-toggle"]'},colors:{lightBlue:"#3c8dbc",red:"#f56954",green:"#00a65a",aqua:"#00c0ef",yellow:"#f39c12",blue:"#0073b7",navy:"#001F3F",teal:"#39CCCC",olive:"#3D9970",lime:"#01FF70",orange:"#FF851B",fuchsia:"#F012BE",purple:"#8E24AA",maroon:"#D81B60",black:"#222222",gray:"#d2d6de"},screenSizes:{xs:480,sm:768,md:992,lg:1200}},$(function(){"undefined"!=typeof ItwayIOOptions&&$.extend(!0,$.ItwayIO.options,ItwayIOOptions);var e=$.ItwayIO.options;_init(e),$.ItwayIO.search.activate(),$.ItwayIO.notifier.activate(),$.ItwayIO.layout.activate(),$.ItwayIO.tree(".sidebar"),e.enableControlSidebar&&$.ItwayIO.controlSidebar.activate(),e.navbarMenuSlimscroll&&"undefined"!=typeof $.fn.slimscroll&&$(".navbar .menu").slimscroll({height:e.navbarMenuHeight,alwaysVisible:!1,size:e.navbarMenuSlimscrollWidth}).css("width","100%"),e.sidebarPushMenu&&$.ItwayIO.pushMenu.activate(e.sidebarToggleSelector),e.enableBoxWidget&&$.ItwayIO.boxWidget.activate(),e.enableFastclick&&"undefined"!=typeof FastClick&&FastClick.attach(document.body),e.directChat.enable&&$(e.directChat.contactToggleSelector).on("click",function(){var e=$(this).parents(".direct-chat").first();e.toggleClass("direct-chat-contacts-open")}),$('.btn-group[data-toggle="btn-toggle"]').each(function(){var e=$(this);$(this).find(".btn").on("click",function(t){e.find(".btn.active").removeClass("active"),$(this).addClass("active"),t.preventDefault()})})}),function(e){e.fn.boxRefresh=function(t){function o(e){e.append(s),a.onLoadStart.call(e)}function i(e){e.find(s).remove(),a.onLoadDone.call(e)}var a=e.extend({trigger:".refresh-btn",source:"",onLoadStart:function(){},onLoadDone:function(){}},t),s=e('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');return this.each(function(){if(""===a.source)return void(console&&console.log("Please specify a source first - boxRefresh()"));var t=e(this),s=t.find(a.trigger).first();s.on("click",function(e){e.preventDefault(),o(t),t.find(".box-body").load(a.source,function(){i(t)})})})}}(jQuery),function(e){e.fn.todolist=function(t){var o=e.extend({onCheck:function(){},onUncheck:function(){}},t);return this.each(function(){"undefined"!=typeof e.fn.iCheck?(e("input",this).on("ifChecked",function(){var t=e(this).parents("li").first();t.toggleClass("done"),o.onCheck.call(t)}),e("input",this).on("ifUnchecked",function(){var t=e(this).parents("li").first();t.toggleClass("done"),o.onUncheck.call(t)})):e("input",this).on("change",function(){var t=e(this).parents("li").first();t.toggleClass("done"),o.onCheck.call(t)})})}}(jQuery);