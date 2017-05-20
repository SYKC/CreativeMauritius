/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("var FirepadUserList = (function() {\n    function FirepadUserList(ref, place, userId, displayName) {\n        if (!(this instanceof FirepadUserList)) {\n            return new FirepadUserList(ref, place, userId, displayName);\n        }\n\n        this.ref_ = ref;\n        this.userId_ = userId;\n        this.place_ = place;\n        this.firebaseCallbacks_ = [];\n\n        var self = this;\n        this.hasName_ = !!displayName;\n        this.displayName_ = displayName || 'Guest ' + Math.floor(Math.random() * 1000);\n        this.firebaseOn_(ref.root.child('.info/connected'), 'value', function(s) {\n            if (s.val() === true && self.displayName_) {\n                var nameRef = ref.child(self.userId_).child('name');\n                nameRef.onDisconnect().remove();\n                nameRef.set(self.displayName_);\n            }\n        });\n\n        this.userList_ = this.makeUserList_()\n        place.appendChild(this.userList_);\n    }\n\n    // This is the primary \"constructor\" for symmetry with Firepad.\n    FirepadUserList.fromDiv = FirepadUserList;\n\n    FirepadUserList.prototype.dispose = function() {\n        this.removeFirebaseCallbacks_();\n        this.ref_.child(this.userId_).child('name').remove();\n\n        this.place_.removeChild(this.userList_);\n    };\n\n    FirepadUserList.prototype.makeUserList_ = function() {\n        return elt('div', [\n            this.makeHeading_(),\n            elt('div', [\n                this.makeUserEntryForSelf_(),\n                this.makeUserEntriesForOthers_()\n            ], { 'class': 'firepad-userlist-users' })\n        ], { 'class': 'firepad-userlist' });\n    };\n\n    FirepadUserList.prototype.makeHeading_ = function() {\n        var counterSpan = elt('span', '0');\n        this.firebaseOn_(this.ref_, 'value', function(usersSnapshot) {\n            setTextContent(counterSpan, \"\" + usersSnapshot.numChildren());\n        });\n\n        return elt('div', [\n            elt('span', 'ONLINE ('),\n            counterSpan,\n            elt('span', ')')\n        ], { 'class': 'firepad-userlist-heading' });\n    };\n\n    FirepadUserList.prototype.makeUserEntryForSelf_ = function() {\n        var myUserRef = this.ref_.child(this.userId_);\n\n        var colorDiv = elt('div', null, { 'class': 'firepad-userlist-color-indicator' });\n        this.firebaseOn_(myUserRef.child('color'), 'value', function(colorSnapshot) {\n            var color = colorSnapshot.val();\n            if (isValidColor(color)) {\n                colorDiv.style.backgroundColor = color;\n            }\n        });\n\n        var nameInput = elt('input', null, { type: 'text', 'class': 'firepad-userlist-name-input' });\n        nameInput.value = this.displayName_;\n\n        var nameHint = elt('div', 'ENTER YOUR NAME', { 'class': 'firepad-userlist-name-hint' });\n        if (this.hasName_) nameHint.style.display = 'none';\n\n        // Update Firebase when name changes.\n        var self = this;\n        on(nameInput, 'change', function(e) {\n            var name = nameInput.value || \"Guest \" + Math.floor(Math.random() * 1000);\n            myUserRef.child('name').onDisconnect().remove();\n            myUserRef.child('name').set(name);\n            nameHint.style.display = 'none';\n            nameInput.blur();\n            self.displayName_ = name;\n            stopEvent(e);\n        });\n\n        var nameDiv = elt('div', [nameInput, nameHint]);\n\n        return elt('div', [colorDiv, nameDiv], {\n            'class': 'firepad-userlist-user ' + 'firepad-user-' + this.userId_\n        });\n    };\n\n    FirepadUserList.prototype.makeUserEntriesForOthers_ = function() {\n        var self = this;\n        var userList = elt('div');\n        var userId2Element = {};\n\n        function updateChild(userSnapshot, prevChildName) {\n            var userId = userSnapshot.key;\n            var div = userId2Element[userId];\n            if (div) {\n                userList.removeChild(div);\n                delete userId2Element[userId];\n            }\n            var name = userSnapshot.child('name').val();\n            if (typeof name !== 'string') { name = 'Guest'; }\n            name = name.substring(0, 20);\n\n            var color = userSnapshot.child('color').val();\n            if (!isValidColor(color)) {\n                color = \"#ffb\"\n            }\n\n            var colorDiv = elt('div', null, { 'class': 'firepad-userlist-color-indicator' });\n            colorDiv.style.backgroundColor = color;\n\n            var nameDiv = elt('div', name || 'Guest', { 'class': 'firepad-userlist-name' });\n\n            var userDiv = elt('div', [colorDiv, nameDiv], {\n                'class': 'firepad-userlist-user ' + 'firepad-user-' + userId\n            });\n            userId2Element[userId] = userDiv;\n\n            if (userId === self.userId_) {\n                // HACK: We go ahead and insert ourself in the DOM, so we can easily order other users against it.\n                // But don't show it.\n                userDiv.style.display = 'none';\n            }\n\n            var nextElement = prevChildName ? userId2Element[prevChildName].nextSibling : userList.firstChild;\n            userList.insertBefore(userDiv, nextElement);\n        }\n\n        this.firebaseOn_(this.ref_, 'child_added', updateChild);\n        this.firebaseOn_(this.ref_, 'child_changed', updateChild);\n        this.firebaseOn_(this.ref_, 'child_moved', updateChild);\n        this.firebaseOn_(this.ref_, 'child_removed', function(removedSnapshot) {\n            var userId = removedSnapshot.key;\n            var div = userId2Element[userId];\n            if (div) {\n                userList.removeChild(div);\n                delete userId2Element[userId];\n            }\n        });\n\n        return userList;\n    };\n\n    FirepadUserList.prototype.firebaseOn_ = function(ref, eventType, callback, context) {\n        this.firebaseCallbacks_.push({ ref: ref, eventType: eventType, callback: callback, context: context });\n        ref.on(eventType, callback, context);\n        return callback;\n    };\n\n    FirepadUserList.prototype.firebaseOff_ = function(ref, eventType, callback, context) {\n        var this$1 = this;\n\n        ref.off(eventType, callback, context);\n        for (var i = 0; i < this.firebaseCallbacks_.length; i++) {\n            var l = this$1.firebaseCallbacks_[i];\n            if (l.ref === ref && l.eventType === eventType && l.callback === callback && l.context === context) {\n                this$1.firebaseCallbacks_.splice(i, 1);\n                break;\n            }\n        }\n    };\n\n    FirepadUserList.prototype.removeFirebaseCallbacks_ = function() {\n        var this$1 = this;\n\n        for (var i = 0; i < this.firebaseCallbacks_.length; i++) {\n            var l = this$1.firebaseCallbacks_[i];\n            l.ref.off(l.eventType, l.callback, l.context);\n        }\n        this.firebaseCallbacks_ = [];\n    };\n\n    /** Assorted helpers */\n\n    function isValidColor(color) {\n        return typeof color === 'string' &&\n            (color.match(/^#[a-fA-F0-9]{3,6}$/) || color == 'transparent');\n    }\n\n\n    /** DOM helpers */\n    function elt(tag, content, attrs) {\n        var e = document.createElement(tag);\n        if (typeof content === \"string\") {\n            setTextContent(e, content);\n        } else if (content) {\n            for (var i = 0; i < content.length; ++i) { e.appendChild(content[i]); }\n        }\n        for (var attr in (attrs || {})) {\n            e.setAttribute(attr, attrs[attr]);\n        }\n        return e;\n    }\n\n    function setTextContent(e, str) {\n        e.innerHTML = \"\";\n        e.appendChild(document.createTextNode(str));\n    }\n\n    function on(emitter, type, f) {\n        if (emitter.addEventListener) {\n            emitter.addEventListener(type, f, false);\n        } else if (emitter.attachEvent) {\n            emitter.attachEvent(\"on\" + type, f);\n        }\n    }\n\n    function off(emitter, type, f) {\n        if (emitter.removeEventListener) {\n            emitter.removeEventListener(type, f, false);\n        } else if (emitter.detachEvent) {\n            emitter.detachEvent(\"on\" + type, f);\n        }\n    }\n\n    function preventDefault(e) {\n        if (e.preventDefault) {\n            e.preventDefault();\n        } else {\n            e.returnValue = false;\n        }\n    }\n\n    function stopPropagation(e) {\n        if (e.stopPropagation) {\n            e.stopPropagation();\n        } else {\n            e.cancelBubble = true;\n        }\n    }\n\n    function stopEvent(e) {\n        preventDefault(e);\n        stopPropagation(e);\n    }\n\n    return FirepadUserList;\n})();//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2Z1bmN0aW9ucy5qcz9kY2EzIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBGaXJlcGFkVXNlckxpc3QgPSAoZnVuY3Rpb24oKSB7XG4gICAgZnVuY3Rpb24gRmlyZXBhZFVzZXJMaXN0KHJlZiwgcGxhY2UsIHVzZXJJZCwgZGlzcGxheU5hbWUpIHtcbiAgICAgICAgaWYgKCEodGhpcyBpbnN0YW5jZW9mIEZpcmVwYWRVc2VyTGlzdCkpIHtcbiAgICAgICAgICAgIHJldHVybiBuZXcgRmlyZXBhZFVzZXJMaXN0KHJlZiwgcGxhY2UsIHVzZXJJZCwgZGlzcGxheU5hbWUpO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy5yZWZfID0gcmVmO1xuICAgICAgICB0aGlzLnVzZXJJZF8gPSB1c2VySWQ7XG4gICAgICAgIHRoaXMucGxhY2VfID0gcGxhY2U7XG4gICAgICAgIHRoaXMuZmlyZWJhc2VDYWxsYmFja3NfID0gW107XG5cbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzO1xuICAgICAgICB0aGlzLmhhc05hbWVfID0gISFkaXNwbGF5TmFtZTtcbiAgICAgICAgdGhpcy5kaXNwbGF5TmFtZV8gPSBkaXNwbGF5TmFtZSB8fCAnR3Vlc3QgJyArIE1hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIDEwMDApO1xuICAgICAgICB0aGlzLmZpcmViYXNlT25fKHJlZi5yb290LmNoaWxkKCcuaW5mby9jb25uZWN0ZWQnKSwgJ3ZhbHVlJywgZnVuY3Rpb24ocykge1xuICAgICAgICAgICAgaWYgKHMudmFsKCkgPT09IHRydWUgJiYgc2VsZi5kaXNwbGF5TmFtZV8pIHtcbiAgICAgICAgICAgICAgICB2YXIgbmFtZVJlZiA9IHJlZi5jaGlsZChzZWxmLnVzZXJJZF8pLmNoaWxkKCduYW1lJyk7XG4gICAgICAgICAgICAgICAgbmFtZVJlZi5vbkRpc2Nvbm5lY3QoKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICBuYW1lUmVmLnNldChzZWxmLmRpc3BsYXlOYW1lXyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIHRoaXMudXNlckxpc3RfID0gdGhpcy5tYWtlVXNlckxpc3RfKClcbiAgICAgICAgcGxhY2UuYXBwZW5kQ2hpbGQodGhpcy51c2VyTGlzdF8pO1xuICAgIH1cblxuICAgIC8vIFRoaXMgaXMgdGhlIHByaW1hcnkgXCJjb25zdHJ1Y3RvclwiIGZvciBzeW1tZXRyeSB3aXRoIEZpcmVwYWQuXG4gICAgRmlyZXBhZFVzZXJMaXN0LmZyb21EaXYgPSBGaXJlcGFkVXNlckxpc3Q7XG5cbiAgICBGaXJlcGFkVXNlckxpc3QucHJvdG90eXBlLmRpc3Bvc2UgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgdGhpcy5yZW1vdmVGaXJlYmFzZUNhbGxiYWNrc18oKTtcbiAgICAgICAgdGhpcy5yZWZfLmNoaWxkKHRoaXMudXNlcklkXykuY2hpbGQoJ25hbWUnKS5yZW1vdmUoKTtcblxuICAgICAgICB0aGlzLnBsYWNlXy5yZW1vdmVDaGlsZCh0aGlzLnVzZXJMaXN0Xyk7XG4gICAgfTtcblxuICAgIEZpcmVwYWRVc2VyTGlzdC5wcm90b3R5cGUubWFrZVVzZXJMaXN0XyA9IGZ1bmN0aW9uKCkge1xuICAgICAgICByZXR1cm4gZWx0KCdkaXYnLCBbXG4gICAgICAgICAgICB0aGlzLm1ha2VIZWFkaW5nXygpLFxuICAgICAgICAgICAgZWx0KCdkaXYnLCBbXG4gICAgICAgICAgICAgICAgdGhpcy5tYWtlVXNlckVudHJ5Rm9yU2VsZl8oKSxcbiAgICAgICAgICAgICAgICB0aGlzLm1ha2VVc2VyRW50cmllc0Zvck90aGVyc18oKVxuICAgICAgICAgICAgXSwgeyAnY2xhc3MnOiAnZmlyZXBhZC11c2VybGlzdC11c2VycycgfSlcbiAgICAgICAgXSwgeyAnY2xhc3MnOiAnZmlyZXBhZC11c2VybGlzdCcgfSk7XG4gICAgfTtcblxuICAgIEZpcmVwYWRVc2VyTGlzdC5wcm90b3R5cGUubWFrZUhlYWRpbmdfID0gZnVuY3Rpb24oKSB7XG4gICAgICAgIHZhciBjb3VudGVyU3BhbiA9IGVsdCgnc3BhbicsICcwJyk7XG4gICAgICAgIHRoaXMuZmlyZWJhc2VPbl8odGhpcy5yZWZfLCAndmFsdWUnLCBmdW5jdGlvbih1c2Vyc1NuYXBzaG90KSB7XG4gICAgICAgICAgICBzZXRUZXh0Q29udGVudChjb3VudGVyU3BhbiwgXCJcIiArIHVzZXJzU25hcHNob3QubnVtQ2hpbGRyZW4oKSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIHJldHVybiBlbHQoJ2RpdicsIFtcbiAgICAgICAgICAgIGVsdCgnc3BhbicsICdPTkxJTkUgKCcpLFxuICAgICAgICAgICAgY291bnRlclNwYW4sXG4gICAgICAgICAgICBlbHQoJ3NwYW4nLCAnKScpXG4gICAgICAgIF0sIHsgJ2NsYXNzJzogJ2ZpcmVwYWQtdXNlcmxpc3QtaGVhZGluZycgfSk7XG4gICAgfTtcblxuICAgIEZpcmVwYWRVc2VyTGlzdC5wcm90b3R5cGUubWFrZVVzZXJFbnRyeUZvclNlbGZfID0gZnVuY3Rpb24oKSB7XG4gICAgICAgIHZhciBteVVzZXJSZWYgPSB0aGlzLnJlZl8uY2hpbGQodGhpcy51c2VySWRfKTtcblxuICAgICAgICB2YXIgY29sb3JEaXYgPSBlbHQoJ2RpdicsIG51bGwsIHsgJ2NsYXNzJzogJ2ZpcmVwYWQtdXNlcmxpc3QtY29sb3ItaW5kaWNhdG9yJyB9KTtcbiAgICAgICAgdGhpcy5maXJlYmFzZU9uXyhteVVzZXJSZWYuY2hpbGQoJ2NvbG9yJyksICd2YWx1ZScsIGZ1bmN0aW9uKGNvbG9yU25hcHNob3QpIHtcbiAgICAgICAgICAgIHZhciBjb2xvciA9IGNvbG9yU25hcHNob3QudmFsKCk7XG4gICAgICAgICAgICBpZiAoaXNWYWxpZENvbG9yKGNvbG9yKSkge1xuICAgICAgICAgICAgICAgIGNvbG9yRGl2LnN0eWxlLmJhY2tncm91bmRDb2xvciA9IGNvbG9yO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICB2YXIgbmFtZUlucHV0ID0gZWx0KCdpbnB1dCcsIG51bGwsIHsgdHlwZTogJ3RleHQnLCAnY2xhc3MnOiAnZmlyZXBhZC11c2VybGlzdC1uYW1lLWlucHV0JyB9KTtcbiAgICAgICAgbmFtZUlucHV0LnZhbHVlID0gdGhpcy5kaXNwbGF5TmFtZV87XG5cbiAgICAgICAgdmFyIG5hbWVIaW50ID0gZWx0KCdkaXYnLCAnRU5URVIgWU9VUiBOQU1FJywgeyAnY2xhc3MnOiAnZmlyZXBhZC11c2VybGlzdC1uYW1lLWhpbnQnIH0pO1xuICAgICAgICBpZiAodGhpcy5oYXNOYW1lXykgbmFtZUhpbnQuc3R5bGUuZGlzcGxheSA9ICdub25lJztcblxuICAgICAgICAvLyBVcGRhdGUgRmlyZWJhc2Ugd2hlbiBuYW1lIGNoYW5nZXMuXG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgb24obmFtZUlucHV0LCAnY2hhbmdlJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgdmFyIG5hbWUgPSBuYW1lSW5wdXQudmFsdWUgfHwgXCJHdWVzdCBcIiArIE1hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIDEwMDApO1xuICAgICAgICAgICAgbXlVc2VyUmVmLmNoaWxkKCduYW1lJykub25EaXNjb25uZWN0KCkucmVtb3ZlKCk7XG4gICAgICAgICAgICBteVVzZXJSZWYuY2hpbGQoJ25hbWUnKS5zZXQobmFtZSk7XG4gICAgICAgICAgICBuYW1lSGludC5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnO1xuICAgICAgICAgICAgbmFtZUlucHV0LmJsdXIoKTtcbiAgICAgICAgICAgIHNlbGYuZGlzcGxheU5hbWVfID0gbmFtZTtcbiAgICAgICAgICAgIHN0b3BFdmVudChlKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdmFyIG5hbWVEaXYgPSBlbHQoJ2RpdicsIFtuYW1lSW5wdXQsIG5hbWVIaW50XSk7XG5cbiAgICAgICAgcmV0dXJuIGVsdCgnZGl2JywgW2NvbG9yRGl2LCBuYW1lRGl2XSwge1xuICAgICAgICAgICAgJ2NsYXNzJzogJ2ZpcmVwYWQtdXNlcmxpc3QtdXNlciAnICsgJ2ZpcmVwYWQtdXNlci0nICsgdGhpcy51c2VySWRfXG4gICAgICAgIH0pO1xuICAgIH07XG5cbiAgICBGaXJlcGFkVXNlckxpc3QucHJvdG90eXBlLm1ha2VVc2VyRW50cmllc0Zvck90aGVyc18gPSBmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzO1xuICAgICAgICB2YXIgdXNlckxpc3QgPSBlbHQoJ2RpdicpO1xuICAgICAgICB2YXIgdXNlcklkMkVsZW1lbnQgPSB7fTtcblxuICAgICAgICBmdW5jdGlvbiB1cGRhdGVDaGlsZCh1c2VyU25hcHNob3QsIHByZXZDaGlsZE5hbWUpIHtcbiAgICAgICAgICAgIHZhciB1c2VySWQgPSB1c2VyU25hcHNob3Qua2V5O1xuICAgICAgICAgICAgdmFyIGRpdiA9IHVzZXJJZDJFbGVtZW50W3VzZXJJZF07XG4gICAgICAgICAgICBpZiAoZGl2KSB7XG4gICAgICAgICAgICAgICAgdXNlckxpc3QucmVtb3ZlQ2hpbGQoZGl2KTtcbiAgICAgICAgICAgICAgICBkZWxldGUgdXNlcklkMkVsZW1lbnRbdXNlcklkXTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIHZhciBuYW1lID0gdXNlclNuYXBzaG90LmNoaWxkKCduYW1lJykudmFsKCk7XG4gICAgICAgICAgICBpZiAodHlwZW9mIG5hbWUgIT09ICdzdHJpbmcnKSB7IG5hbWUgPSAnR3Vlc3QnOyB9XG4gICAgICAgICAgICBuYW1lID0gbmFtZS5zdWJzdHJpbmcoMCwgMjApO1xuXG4gICAgICAgICAgICB2YXIgY29sb3IgPSB1c2VyU25hcHNob3QuY2hpbGQoJ2NvbG9yJykudmFsKCk7XG4gICAgICAgICAgICBpZiAoIWlzVmFsaWRDb2xvcihjb2xvcikpIHtcbiAgICAgICAgICAgICAgICBjb2xvciA9IFwiI2ZmYlwiXG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHZhciBjb2xvckRpdiA9IGVsdCgnZGl2JywgbnVsbCwgeyAnY2xhc3MnOiAnZmlyZXBhZC11c2VybGlzdC1jb2xvci1pbmRpY2F0b3InIH0pO1xuICAgICAgICAgICAgY29sb3JEaXYuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gY29sb3I7XG5cbiAgICAgICAgICAgIHZhciBuYW1lRGl2ID0gZWx0KCdkaXYnLCBuYW1lIHx8ICdHdWVzdCcsIHsgJ2NsYXNzJzogJ2ZpcmVwYWQtdXNlcmxpc3QtbmFtZScgfSk7XG5cbiAgICAgICAgICAgIHZhciB1c2VyRGl2ID0gZWx0KCdkaXYnLCBbY29sb3JEaXYsIG5hbWVEaXZdLCB7XG4gICAgICAgICAgICAgICAgJ2NsYXNzJzogJ2ZpcmVwYWQtdXNlcmxpc3QtdXNlciAnICsgJ2ZpcmVwYWQtdXNlci0nICsgdXNlcklkXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIHVzZXJJZDJFbGVtZW50W3VzZXJJZF0gPSB1c2VyRGl2O1xuXG4gICAgICAgICAgICBpZiAodXNlcklkID09PSBzZWxmLnVzZXJJZF8pIHtcbiAgICAgICAgICAgICAgICAvLyBIQUNLOiBXZSBnbyBhaGVhZCBhbmQgaW5zZXJ0IG91cnNlbGYgaW4gdGhlIERPTSwgc28gd2UgY2FuIGVhc2lseSBvcmRlciBvdGhlciB1c2VycyBhZ2FpbnN0IGl0LlxuICAgICAgICAgICAgICAgIC8vIEJ1dCBkb24ndCBzaG93IGl0LlxuICAgICAgICAgICAgICAgIHVzZXJEaXYuc3R5bGUuZGlzcGxheSA9ICdub25lJztcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgdmFyIG5leHRFbGVtZW50ID0gcHJldkNoaWxkTmFtZSA/IHVzZXJJZDJFbGVtZW50W3ByZXZDaGlsZE5hbWVdLm5leHRTaWJsaW5nIDogdXNlckxpc3QuZmlyc3RDaGlsZDtcbiAgICAgICAgICAgIHVzZXJMaXN0Lmluc2VydEJlZm9yZSh1c2VyRGl2LCBuZXh0RWxlbWVudCk7XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLmZpcmViYXNlT25fKHRoaXMucmVmXywgJ2NoaWxkX2FkZGVkJywgdXBkYXRlQ2hpbGQpO1xuICAgICAgICB0aGlzLmZpcmViYXNlT25fKHRoaXMucmVmXywgJ2NoaWxkX2NoYW5nZWQnLCB1cGRhdGVDaGlsZCk7XG4gICAgICAgIHRoaXMuZmlyZWJhc2VPbl8odGhpcy5yZWZfLCAnY2hpbGRfbW92ZWQnLCB1cGRhdGVDaGlsZCk7XG4gICAgICAgIHRoaXMuZmlyZWJhc2VPbl8odGhpcy5yZWZfLCAnY2hpbGRfcmVtb3ZlZCcsIGZ1bmN0aW9uKHJlbW92ZWRTbmFwc2hvdCkge1xuICAgICAgICAgICAgdmFyIHVzZXJJZCA9IHJlbW92ZWRTbmFwc2hvdC5rZXk7XG4gICAgICAgICAgICB2YXIgZGl2ID0gdXNlcklkMkVsZW1lbnRbdXNlcklkXTtcbiAgICAgICAgICAgIGlmIChkaXYpIHtcbiAgICAgICAgICAgICAgICB1c2VyTGlzdC5yZW1vdmVDaGlsZChkaXYpO1xuICAgICAgICAgICAgICAgIGRlbGV0ZSB1c2VySWQyRWxlbWVudFt1c2VySWRdO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICByZXR1cm4gdXNlckxpc3Q7XG4gICAgfTtcblxuICAgIEZpcmVwYWRVc2VyTGlzdC5wcm90b3R5cGUuZmlyZWJhc2VPbl8gPSBmdW5jdGlvbihyZWYsIGV2ZW50VHlwZSwgY2FsbGJhY2ssIGNvbnRleHQpIHtcbiAgICAgICAgdGhpcy5maXJlYmFzZUNhbGxiYWNrc18ucHVzaCh7IHJlZjogcmVmLCBldmVudFR5cGU6IGV2ZW50VHlwZSwgY2FsbGJhY2s6IGNhbGxiYWNrLCBjb250ZXh0OiBjb250ZXh0IH0pO1xuICAgICAgICByZWYub24oZXZlbnRUeXBlLCBjYWxsYmFjaywgY29udGV4dCk7XG4gICAgICAgIHJldHVybiBjYWxsYmFjaztcbiAgICB9O1xuXG4gICAgRmlyZXBhZFVzZXJMaXN0LnByb3RvdHlwZS5maXJlYmFzZU9mZl8gPSBmdW5jdGlvbihyZWYsIGV2ZW50VHlwZSwgY2FsbGJhY2ssIGNvbnRleHQpIHtcbiAgICAgICAgcmVmLm9mZihldmVudFR5cGUsIGNhbGxiYWNrLCBjb250ZXh0KTtcbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCB0aGlzLmZpcmViYXNlQ2FsbGJhY2tzXy5sZW5ndGg7IGkrKykge1xuICAgICAgICAgICAgdmFyIGwgPSB0aGlzLmZpcmViYXNlQ2FsbGJhY2tzX1tpXTtcbiAgICAgICAgICAgIGlmIChsLnJlZiA9PT0gcmVmICYmIGwuZXZlbnRUeXBlID09PSBldmVudFR5cGUgJiYgbC5jYWxsYmFjayA9PT0gY2FsbGJhY2sgJiYgbC5jb250ZXh0ID09PSBjb250ZXh0KSB7XG4gICAgICAgICAgICAgICAgdGhpcy5maXJlYmFzZUNhbGxiYWNrc18uc3BsaWNlKGksIDEpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfTtcblxuICAgIEZpcmVwYWRVc2VyTGlzdC5wcm90b3R5cGUucmVtb3ZlRmlyZWJhc2VDYWxsYmFja3NfID0gZnVuY3Rpb24oKSB7XG4gICAgICAgIGZvciAodmFyIGkgPSAwOyBpIDwgdGhpcy5maXJlYmFzZUNhbGxiYWNrc18ubGVuZ3RoOyBpKyspIHtcbiAgICAgICAgICAgIHZhciBsID0gdGhpcy5maXJlYmFzZUNhbGxiYWNrc19baV07XG4gICAgICAgICAgICBsLnJlZi5vZmYobC5ldmVudFR5cGUsIGwuY2FsbGJhY2ssIGwuY29udGV4dCk7XG4gICAgICAgIH1cbiAgICAgICAgdGhpcy5maXJlYmFzZUNhbGxiYWNrc18gPSBbXTtcbiAgICB9O1xuXG4gICAgLyoqIEFzc29ydGVkIGhlbHBlcnMgKi9cblxuICAgIGZ1bmN0aW9uIGlzVmFsaWRDb2xvcihjb2xvcikge1xuICAgICAgICByZXR1cm4gdHlwZW9mIGNvbG9yID09PSAnc3RyaW5nJyAmJlxuICAgICAgICAgICAgKGNvbG9yLm1hdGNoKC9eI1thLWZBLUYwLTldezMsNn0kLykgfHwgY29sb3IgPT0gJ3RyYW5zcGFyZW50Jyk7XG4gICAgfVxuXG5cbiAgICAvKiogRE9NIGhlbHBlcnMgKi9cbiAgICBmdW5jdGlvbiBlbHQodGFnLCBjb250ZW50LCBhdHRycykge1xuICAgICAgICB2YXIgZSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQodGFnKTtcbiAgICAgICAgaWYgKHR5cGVvZiBjb250ZW50ID09PSBcInN0cmluZ1wiKSB7XG4gICAgICAgICAgICBzZXRUZXh0Q29udGVudChlLCBjb250ZW50KTtcbiAgICAgICAgfSBlbHNlIGlmIChjb250ZW50KSB7XG4gICAgICAgICAgICBmb3IgKHZhciBpID0gMDsgaSA8IGNvbnRlbnQubGVuZ3RoOyArK2kpIHsgZS5hcHBlbmRDaGlsZChjb250ZW50W2ldKTsgfVxuICAgICAgICB9XG4gICAgICAgIGZvciAodmFyIGF0dHIgaW4gKGF0dHJzIHx8IHt9KSkge1xuICAgICAgICAgICAgZS5zZXRBdHRyaWJ1dGUoYXR0ciwgYXR0cnNbYXR0cl0pO1xuICAgICAgICB9XG4gICAgICAgIHJldHVybiBlO1xuICAgIH1cblxuICAgIGZ1bmN0aW9uIHNldFRleHRDb250ZW50KGUsIHN0cikge1xuICAgICAgICBlLmlubmVySFRNTCA9IFwiXCI7XG4gICAgICAgIGUuYXBwZW5kQ2hpbGQoZG9jdW1lbnQuY3JlYXRlVGV4dE5vZGUoc3RyKSk7XG4gICAgfVxuXG4gICAgZnVuY3Rpb24gb24oZW1pdHRlciwgdHlwZSwgZikge1xuICAgICAgICBpZiAoZW1pdHRlci5hZGRFdmVudExpc3RlbmVyKSB7XG4gICAgICAgICAgICBlbWl0dGVyLmFkZEV2ZW50TGlzdGVuZXIodHlwZSwgZiwgZmFsc2UpO1xuICAgICAgICB9IGVsc2UgaWYgKGVtaXR0ZXIuYXR0YWNoRXZlbnQpIHtcbiAgICAgICAgICAgIGVtaXR0ZXIuYXR0YWNoRXZlbnQoXCJvblwiICsgdHlwZSwgZik7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBvZmYoZW1pdHRlciwgdHlwZSwgZikge1xuICAgICAgICBpZiAoZW1pdHRlci5yZW1vdmVFdmVudExpc3RlbmVyKSB7XG4gICAgICAgICAgICBlbWl0dGVyLnJlbW92ZUV2ZW50TGlzdGVuZXIodHlwZSwgZiwgZmFsc2UpO1xuICAgICAgICB9IGVsc2UgaWYgKGVtaXR0ZXIuZGV0YWNoRXZlbnQpIHtcbiAgICAgICAgICAgIGVtaXR0ZXIuZGV0YWNoRXZlbnQoXCJvblwiICsgdHlwZSwgZik7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBwcmV2ZW50RGVmYXVsdChlKSB7XG4gICAgICAgIGlmIChlLnByZXZlbnREZWZhdWx0KSB7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlLnJldHVyblZhbHVlID0gZmFsc2U7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBzdG9wUHJvcGFnYXRpb24oZSkge1xuICAgICAgICBpZiAoZS5zdG9wUHJvcGFnYXRpb24pIHtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlLmNhbmNlbEJ1YmJsZSA9IHRydWU7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBmdW5jdGlvbiBzdG9wRXZlbnQoZSkge1xuICAgICAgICBwcmV2ZW50RGVmYXVsdChlKTtcbiAgICAgICAgc3RvcFByb3BhZ2F0aW9uKGUpO1xuICAgIH1cblxuICAgIHJldHVybiBGaXJlcGFkVXNlckxpc3Q7XG59KSgpO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2Z1bmN0aW9ucy5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);