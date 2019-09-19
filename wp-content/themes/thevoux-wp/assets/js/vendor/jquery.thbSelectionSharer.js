/*
 * Author: Ant Ekşiler (Fuel Themes)
 */

(function($) {

  var thbSelectionSharer = function(options) {

    var self = this;

    options = options || {};
    if(typeof options == 'string')
        options = { elements: options };

    this.sel = null;
    this.textSelection='';
    this.htmlSelection='';
		this.app_id = $('#thbSelectionSharerPopover').data('appid');
		this.viaTwitterAccount = $('#thbSelectionSharerPopover').data('user');
    this.url2share = $('meta[property="og:url"]').attr("content") || $('meta[property="og:url"]').attr("value") || window.location.href;

    this.getSelectionText = function(sel) {
        var html = "", text = "";
        var sel = sel || window.getSelection();
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }
            text = container.textContent;
            html = container.innerHTML
        }
        self.textSelection = text;
        self.htmlSelection = html || text;
        return text;
    };

    this.selectionDirection = function(selection) {
      var sel = selection || window.getSelection();
      var range = document.createRange();
      if(!sel.anchorNode) return 0;
      range.setStart(sel.anchorNode, sel.anchorOffset);
      range.setEnd(sel.focusNode, sel.focusOffset);
      var direction = (range.collapsed) ? "backward" : "forward";
      
      return direction;
    };
		this.getSelectionDimensions = function() {
		    var sel = window.getSelection(), range;
		    var width = 0, height = 0, top = 0, left = 0;
				var winscroll = $(window).scrollTop();
        if (sel.rangeCount) {
            range = sel.getRangeAt(0).cloneRange();
            if (range.getBoundingClientRect) {
                var rect = range.getBoundingClientRect();
                width = Math.ceil(rect.right - rect.left);
                height = Math.ceil(rect.bottom - rect.top);
                top = Math.ceil(winscroll + rect.top - self.$popover.height());
                left = Math.ceil(rect.left  - self.$popover.width() / 2);
            }
        }
		    return { width: width , height: height, offsetTop: top, offsetLeft: left };
		};
    this.show = function(e) {
      setTimeout(function() {
        var sel = window.getSelection();
        var selection = self.getSelectionText(sel);
        if(!sel.isCollapsed && selection && selection.length>10 && selection.match(/ /)) {
          if(e) {
            left = self.getSelectionDimensions().offsetLeft + self.getSelectionDimensions().width / 2;
            top = self.getSelectionDimensions().offsetTop;
          }
          self.$popover.removeClass("anim").css({
						left: left,
          	top: self.getSelectionDimensions().offsetTop - 10
          }).show();
          setTimeout(function() {
            self.$popover.addClass("anim").css("top", top);
          }, 0);
        }
      }, 10);
    };

    this.hide = function(e) {
      self.$popover.hide();
    };

    this.smart_truncate = function(str, n){
        if (!str || !str.length) return str;
        var toLong = str.length>n,
            s_ = toLong ? str.substr(0,n-1) : str;
        s_ = toLong ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
        return  toLong ? s_ +'...' : s_;
    };

    this.shareTwitter = function(e) {
      e.preventDefault();
      var text = "“"+self.smart_truncate(self.textSelection.trim(), 114)+"”";
      var url = 'http://twitter.com/intent/tweet?text='+encodeURIComponent(text)+'&url='+encodeURIComponent(window.location.href);

      // We only show the via @twitter:site if we have enough room
      if(self.viaTwitterAccount && text.length < (120-6-self.viaTwitterAccount.length))
        url += '&via='+self.viaTwitterAccount;

      var w = 640, h=440;
      var left = (screen.width/2)-(w/2);
      var top = (screen.height/2)-(h/2)-100;
      window.open(url, "share_twitter", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
      self.hide();
      return false;
    };

    this.shareFacebook = function(e) {
      e.preventDefault();
      var text = self.htmlSelection.replace(/<p[^>]*>/ig,'\n').replace(/<\/p>|  /ig,'').trim();

      var url = 'http://www.facebook.com/dialog/share?' +
      					'&app_id='+self.app_id+
                '&display=popup'+
                '&name='+encodeURIComponent(text)+
                '&link='+encodeURIComponent(self.url2share)+
                '&href='+encodeURIComponent(self.url2share)+
                '&redirect_uri='+encodeURIComponent(self.url2share);
      var w = 640, h=440;
      var left = (screen.width/2)-(w/2);
      var top = (screen.height/2)-(h/2)-100;

      window.open(url, "share_facebook", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
     	self.hide();
      return false;
    };

    this.shareEmail = function(e) {
      var text = self.htmlSelection.replace(/<p[^>]*>/ig,'\n').replace(/<\/p>|  /ig,'').trim();
      var email = {};
      email.subject = encodeURIComponent("Quote from "+document.title);
      email.body = encodeURIComponent("“"+text+"”")+"%0D%0A%0D%0AFrom: "+document.title+"%0D%0A"+window.location.href;
      $(this).attr("href","mailto:?subject="+email.subject+"&body="+email.body);
      self.hide();
      return true;
    };

    this.render = function() {
      self.$popover = $('#thbSelectionSharerPopover');
      self.$popover.find('a.twitter').on('click', self.shareTwitter);
      self.$popover.find('a.facebook').on('click', self.shareFacebook);
      self.$popover.find('a.email').on('click', self.shareEmail);
    };

    this.setElements = function(elements) {
      if(typeof elements == 'string') elements = $(elements);
      self.$elements = elements instanceof $ ? elements : $(elements);
      self.$elements.mouseup(self.show).mousedown(self.hide);

      
      self.$elements.bind('touchstart', function(e) {
        self.isMobile = true;
      });

      document.onselectionchange = self.selectionChanged;
    };

    this.selectionChanged = function(e) {
      if(!self.isMobile) return;
    };

    this.render();

    if(options.elements) {
      this.setElements(options.elements);
    }

  };

  // jQuery plugin
  // Usage: $( "p" ).selectionSharer();
  $.fn.thbSelectionSharer = function() {
    var sharer = new thbSelectionSharer();
    sharer.setElements(this);
    return this;
  };

  // For AMD / requirejs
  // Usage: require(["selection-sharer!"]);
  //     or require(["selection-sharer"], function(selectionSharer) { var sharer = new SelectionSharer('p'); });
  if(typeof define == 'function') {
    define(function() {
      thbSelectionSharer.load = function (name, req, onLoad, config) {
        var sharer = new SelectionSharer();
        sharer.setElements('p');
        onLoad();
      };
      return thbSelectionSharer;
    });

  }
  else {
    // Registering SelectionSharer as a global
    // Usage: var sharer = new SelectionSharer('p');
    window.thbSelectionSharer = thbSelectionSharer;
  }

})(jQuery);