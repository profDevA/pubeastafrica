window.NSLPopupCenter = function (url, title, w, h) {
    var userAgent = navigator.userAgent,
        mobile = function () {
            return /\b(iPhone|iP[ao]d)/.test(userAgent) ||
                /\b(iP[ao]d)/.test(userAgent) ||
                /Android/i.test(userAgent) ||
                /Mobile/i.test(userAgent);
        },
        screenX = window.screenX !== undefined ? window.screenX : window.screenLeft,
        screenY = window.screenY !== undefined ? window.screenY : window.screenTop,
        outerWidth = window.outerWidth !== undefined ? window.outerWidth : document.documentElement.clientWidth,
        outerHeight = window.outerHeight !== undefined ? window.outerHeight : document.documentElement.clientHeight - 22,
        targetWidth = mobile() ? null : w,
        targetHeight = mobile() ? null : h,
        V = screenX < 0 ? window.screen.width + screenX : screenX,
        left = parseInt(V + (outerWidth - targetWidth) / 2, 10),
        right = parseInt(screenY + (outerHeight - targetHeight) / 2.5, 10),
        features = [];
    if (targetWidth !== null) {
        features.push('width=' + targetWidth);
    }
    if (targetHeight !== null) {
        features.push('height=' + targetHeight);
    }
    features.push('left=' + left);
    features.push('top=' + right);
    features.push('scrollbars=1');

    var newWindow = window.open(url, title, features.join(','));

    if (window.focus) {
        newWindow.focus();
    }

    return newWindow;
};

var isWebView = null;

function checkWebView() {
    if (isWebView === null) {
        function _detectOS(ua) {
            switch (true) {
                case /Android/.test(ua):
                    return "Android";
                case /iPhone|iPad|iPod/.test(ua):
                    return "iOS";
                case /Windows/.test(ua):
                    return "Windows";
                case /Mac OS X/.test(ua):
                    return "Mac";
                case /CrOS/.test(ua):
                    return "Chrome OS";
                case /Firefox/.test(ua):
                    return "Firefox OS";
            }
            return "";
        }

        function _detectBrowser(ua) {
            var android = /Android/.test(ua);

            switch (true) {
                case /CriOS/.test(ua):
                    return "Chrome for iOS";
                case /Edge/.test(ua):
                    return "Edge";
                case android && /Silk\//.test(ua):
                    return "Silk";
                case /Chrome/.test(ua):
                    return "Chrome";
                case /Firefox/.test(ua):
                    return "Firefox";
                case android:
                    return "AOSP";
                case /MSIE|Trident/.test(ua):
                    return "IE";
                case /Safari\//.test(ua):
                    return "Safari";
                case /AppleWebKit/.test(ua):
                    return "WebKit";
            }
            return "";
        }

        function _detectBrowserVersion(ua, browser) {
            switch (browser) {
                case "Chrome for iOS":
                    return _getVersion(ua, "CriOS/");
                case "Edge":
                    return _getVersion(ua, "Edge/");
                case "Chrome":
                    return _getVersion(ua, "Chrome/");
                case "Firefox":
                    return _getVersion(ua, "Firefox/");
                case "Silk":
                    return _getVersion(ua, "Silk/");
                case "AOSP":
                    return _getVersion(ua, "Version/");
                case "IE":
                    return /IEMobile/.test(ua) ? _getVersion(ua, "IEMobile/") :
                        /MSIE/.test(ua) ? _getVersion(ua, "MSIE ")
                            :
                            _getVersion(ua, "rv:");
                case "Safari":
                    return _getVersion(ua, "Version/");
                case "WebKit":
                    return _getVersion(ua, "WebKit/");
            }
            return "0.0.0";
        }

        function _getVersion(ua, token) {
            try {
                return _normalizeSemverString(ua.split(token)[1].trim().split(/[^\w\.]/)[0]);
            } catch (o_O) {
            }
            return "0.0.0";
        }

        function _normalizeSemverString(version) {
            var ary = version.split(/[\._]/);
            return (parseInt(ary[0], 10) || 0) + "." +
                (parseInt(ary[1], 10) || 0) + "." +
                (parseInt(ary[2], 10) || 0);
        }

        function _isWebView(ua, os, browser, version, options) {
            switch (os + browser) {
                case "iOSSafari":
                    return false;
                case "iOSWebKit":
                    return _isWebView_iOS(options);
                case "AndroidAOSP":
                    return false;
                case "AndroidChrome":
                    return parseFloat(version) >= 42 ? /; wv/.test(ua) : /\d{2}\.0\.0/.test(version) ? true : _isWebView_Android(options);
            }
            return false;
        }

        function _isWebView_iOS(options) {
            var document = (window["document"] || {});

            if ("WEB_VIEW" in options) {
                return options["WEB_VIEW"];
            }
            return !("fullscreenEnabled" in document || "webkitFullscreenEnabled" in document || false);
        }

        function _isWebView_Android(options) {
            if ("WEB_VIEW" in options) {
                return options["WEB_VIEW"];
            }
            return !("requestFileSystem" in window || "webkitRequestFileSystem" in window || false);
        }

        var options = {};
        var nav = window.navigator || {};
        var ua = nav.userAgent || "";
        var os = _detectOS(ua);
        var browser = _detectBrowser(ua);
        var browserVersion = _detectBrowserVersion(ua, browser);

        isWebView = _isWebView(ua, os, browser, browserVersion, options);
    }

    return isWebView;
}

window._nsl.push(function ($) {
    var targetWindow = _targetWindow || 'prefer-popup';

    $('a[data-plugin="nsl"][data-action="connect"],a[data-plugin="nsl"][data-action="link"]').on('click', function (e) {
        var $target = $(this),
            href = $target.attr('href'),
            success = false;
        if (href.indexOf('?') !== -1) {
            href += '&';
        } else {
            href += '?';
        }
        var redirectTo = $target.data('redirect');
        if (redirectTo === 'current') {
            href += 'redirect=' + encodeURIComponent(window.location.href) + '&';
        } else if (redirectTo && redirectTo !== '') {
            href += 'redirect=' + encodeURIComponent(redirectTo) + '&';
        }

        if (targetWindow !== 'prefer-same-window' && checkWebView()) {
            targetWindow = 'prefer-same-window';
        }

        if (targetWindow === 'prefer-popup') {
            if (NSLPopupCenter(href + 'display=popup', 'nsl-social-connect', $target.data('popupwidth'), $target.data('popupheight'))) {
                success = true;
                e.preventDefault();
            }
        } else if (targetWindow === 'prefer-new-tab') {
            var newTab = window.open(href + 'display=popup', '_blank');
            if (newTab) {
                if (window.focus) {
                    newTab.focus();
                }
                success = true;
                e.preventDefault();
            }
        }

        if (!success) {
            window.location = href;
            e.preventDefault();
        }
    });

    var googleLoginButton = $('a[data-plugin="nsl"][data-provider="google"]');
    if (googleLoginButton.length && checkWebView()) {
        googleLoginButton.remove();
    }
});