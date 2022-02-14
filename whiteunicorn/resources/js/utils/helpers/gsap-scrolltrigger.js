//-- Scroll Trigger Animations with GSAP --//
import log from "./console-log";
import lazyLoad from "./simple-lazy-load";
import { pI, pF } from "./numbers";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { SplitText } from "gsap/SplitText";

gsap.registerPlugin(ScrollTrigger);

export default function setScrollTrigger() {//log("scrollTrigger->this",this);
    var $this = (this instanceof jQuery === false) ? $(this) : (this.length === 1) ? this : this.first(),
        settings = (typeof($this.data("scrolltrigger")) === "string") ? { animation:$this.data("scrolltrigger") } : $this.data("scrolltrigger");
    if (!$this.data("scrolltrigger") || $this.data("scrolltrigger") == "") { return; }//log("settings:",settings);

  
    //Init
    if (settings.splittext) { addSplitText(); }//TODO
    var $target = getTarget();
    setup();
    var animation = getAnimationObj(settings);//log("scrollTrigger->Animation:", animation);
    if (settings.init) { runFunction("init"); }
    if (settings.animation == ("fromTo")) {
      //TODO: gsap.fromTo($target, { getFrom() }, { getTo() });
    }
    else {
      gsap.from($target, animation);
    }
    
  
    //Functions
    function getAnimationObj(settings) {
      var obj = {
          duration: settings.duration,
          delay: settings.delay,
          ease: settings.ease,
          stagger: settings.stagger,
          scrollTrigger: {
              trigger: settings.trigger,
              start: settings.start,
              end: settings.end,
              scrub: settings.scrub,
                once: settings.runOnce,
              markers: settings.markers
          },
          onComplete: onComplete
      };
      
      //Fade
      if (settings.animation.includes("fadeIn")) {
        obj.autoAlpha = 0;
      }
      //Animation
      if (settings.animation.includes(".from")) {
          setAnimation();
      }
      //ScrollTrigger Callbacks
      setSTCallbacks();
        
      return obj;
    
      //Callbacks
      function setSTCallbacks() {
        var setLazyLoad = (settings.lazyload && settings.lazyload == "true");
      
        if (settings.onEnter || settings.onEnterBack || setLazyLoad) {
            if (settings.onEnter || setLazyLoad) {
                obj.scrollTrigger.onEnter = function() {
                  if (setLazyLoad) {
                    $this.find("img").each(lazyLoad);
                  }
                  if (settings.onEnter) { runFunction("onEnter"); }
                }
            }
            if (settings.onEnterBack || setLazyLoad) {
                obj.scrollTrigger.onEnterBack = function() {
                  if (setLazyLoad) { //*Note: lazy load is placed onEnter && onEnterBack to ensure it gets called in either direction
                    $this.find("img").each(lazyLoad);
                  }
                  if (settings.onEnterBefore) { runFunction("onEnterBefore"); }
                }
            }
        }
        if (settings.onLeave) {
            obj.scrollTrigger.onLeave = function() {
                runFunction("onLeave");
            }
        }
        if (settings.onLeaveBack) {
            obj.scrollTrigger.onLeaveBack = function() {
                runFunction("onLeaveBack");
            }
        }
        if (settings.onUpdate) {
            $this.append(`<div class="progress-updater" style="display:none;"></div>`);
            var $progress = $this.find(".progress-updater");
            obj.scrollTrigger.onUpdate = function(progress) {//log("progress", progress);
                var progObj = { progress: progress.progress, direction: progress.direction, isActive: progress.isActive };
                $progress.html(JSON.stringify(progObj));
                runFunction("onUpdate");
            }
        }
      }
      //Animation
      function setAnimation() {
        var _animation = settings.animation.split(".")[1],
            distance = (settings.distance) ? getDistance(settings) : false;//log("distance:",distance);
      
        if (_animation == "fromLeft" || _animation == "fromRight" || _animation == "fromTop" || _animation == "fromBottom") {
          var transitionProperty,
              transitionValue;
        
          transitionProperty = (_animation == "fromLeft" || _animation == "fromRight") ? "x" : "y";
          if (distance != false && settings.distance.includes("%")) {
              transitionProperty += 'Percent';
          }
          
          transitionValue = (distance != false) ? pI(distance) : (_animation == "fromLeft" || _animation == "fromTop") ? -100 : 100;
        
          obj[transitionProperty] = transitionValue;
        }
        //FromTo (TODO)
        else if (settings.animation == ("fromTo")) {
          //Must use settings.fromTo
        }
      }
      function onComplete() {
        if ($target.attr("data-transition")) { gsap.set($target, { clearProps: "transition" }); }
        if (settings.clearProps && settings.clearProps === "true") { gsap.set($target, { clearProps: true }); }
        if (settings.onComplete) {
          runFunction("onComplete");
        }
      }
    }
    function setup() {
      settings.duration = getDuration();
      settings.start = (settings.start) ? settings.start : "top 80%";
      settings.end = (settings.end) ? settings.end : "bottom top";
      settings.ease = (settings.ease) ? settings.ease : "power4";
      settings.delay = (settings.delay) ? settings.delay : 0;
      settings.animation = (settings.animation) ? settings.animation : "fadeIn";
      settings.scrub = (settings.scrub) ? settings.scrub : false;
      settings.trigger = (settings.trigger) ? getTrigger() : $target;
      settings.stagger = (settings.stagger) ? (settings.stagger.includes("{")) ? eval(`(${settings.stagger})`) : settings.stagger : 0;
      settings.runOnce = (settings.runOnce) ? (settings.runOnce == "true") : true;
      settings.markers = (settings.markers) ? (settings.markers == "true") : false;
      settings.splittext = (settings.splittext) ? settings.splittext : false;
    }
    function addSplitText() {
      var _settings = eval(`(${settings.splittext})`),
          _$this = (_settings.target === "this" || _settings.target === "$this") ? $this : $this.find(_settings.target);
      if (_settings == "") { return; }//log("text animation: ", settings);
      //Split text
      _settings.type = (_settings.type) ? _settings.type : "words";
      _settings.charsClass = (_settings.charsClass) ? _settings.charsClass : "char splitText-item";
      _settings.wordsClass = (_settings.wordsClass) ? _settings.wordsClass : "word splitText-item";
      _settings.linesClass = (_settings.linesClass) ? _settings.linesClass : "line splitText-item";
      //Animation
      _settings.duration = (_settings.duration) ? pI(_settings.duration) : 1;
      _settings.start = (_settings.start) ? _settings.start : "top bottom";
      _settings.end = (_settings.end) ? _settings.end : "bottom top";
      _settings.toggleActions = (_settings.toggleActions) ? _settings.toggleActions : "play reset resume reset";

      var textSplit = new SplitText(_$this, { type: _settings.type, charsClass: _settings.charsClass, wordsClass: _settings.wordsClass, linesClass: _settings.linesClass });
      //Custom wrapper elements
      if (_settings.wrapChars) { wrapChars(_$this); }
      if (_settings.wrapWords) { wrapWords(_$this); }
      if (_settings.wrapLines) { wrapLines(_$this); }
    }
    function getDuration() {
      var duration = (settings.duration),
          curTransVal = $target.css("transition");
      if (duration && settings.duration != "null") {
        duration = pF(settings.duration);
        //Check if has transition value already set. If so remove temporarily and re-set during onComplete
        if (!curTransVal.includes("all 0s")) {
            $target.css("transition", "initial").attr("data-transition", curTransVal);
        }
      }
      else {
        //Check if has no transition value is set. If not then set duration to 1s.
        if (curTransVal.includes("all 0s")) {
            duration = 1.5;//Default
        }
        //else if $target has transition set transition to that
        else {
            var curTD = $target.css("transitionDuration").split("s")[0];
            duration = curTD;
            $target.css("transition", "initial").attr("data-transition", curTransVal);
        }
      }
      return duration;
    }
    function getDistance(settings) {//checks if distance is set properly
      var distance = settings.distance,
          animation = settings.animation;
      if (animation.includes("Left") || animation.includes("Top")) {
        if (pI(distance) > 0) {//log("old distance:",distance);
          distance = (distance.includes("%")) ? `${pI(distance) * -1}%` : distance * -1;//log("new distance:",distance);
        }
      }
      return distance;
    }
    function getTrigger() {
      var trigger = settings.trigger;
      //Run a function that returns an element Ex: trigger:"$this.parent()" || "$this.closest("section")
      if (trigger.includes("$")) {
        trigger = eval(trigger);
      }
      return trigger;
    }
    function getTarget() {
      var $target = $this;
      if (settings.target) {
        if (settings.target.includes("$")) {
          $target = eval(settings.target);
        }
        else { $target = $this.find(settings.target); }
      }
    
      return $target;
    }
    function runFunction(settingFn) {
      try { eval(settings[settingFn]); }
      catch(err) { log(`strolltrigger ${settingFn} ERROR`, err); }
    }
}