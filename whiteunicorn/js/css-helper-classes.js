/**
 * CSS Helper Classes
 * Generate helper classes and add styles to page
 * Dependencies: jQuery
 */
jQuery(document).ready(function() {
  var defaultSizes = [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100,105,110,115,120,125,130,135,140,145,150,155,160,170,180,190,200,210,220,230,240,250,260];
  var mediaQueries = [
    {
      "media": "desktop",
      "query": false,
      "suffix": ''
    },
     {
      "media": "1600",
      "query": "only screen and (max-width: 1600px)",
      "suffix": "--1600"
    },
     {
      "media": "1400",
      "query": "only screen and (max-width: 1400px)",
      "suffix": "--1400"
    },
     {
      "media": "1200",
      "query": "only screen and (max-width: 1200px)",
      "suffix": "--1200"
    },
     {
      "media": "1023",
      "query": "only screen and (max-width: 1023px)",
      "suffix": "--t"
    },
     {
      "media": "phone",
      "query": "(max-width: 767px), screen and (max-width: 812px) and (orientation: landscape)",
      "suffix": "--m"
    },
     {
      "media": "500",
      "query": "only screen and (max-width: 500px)",
      "suffix": "--500"
    },
     {
      "media": "375",
      "query": "only screen and (max-width: 375px)",
      "suffix": "--sm"
    },
  ];
  var properties = [
    //Margin
    {
      "name": "margin-top",
      "class": "mt",
      "values": defaultSizes,
      "unit": "px"
    },
    {
      "name": "margin-top",
      "class": "mt",
      "values": [ [".25em","_25em"],[".5em","_5em"],[".75em","_75em"],["1em","1em"],["1.25em","1_25em"],["1.5em","1_5em"],["1.75em","1_75em"],["2em","2em"] ]
    },
    {
      "name": "margin-bottom",
      "class": "mb",
      "values": defaultSizes,
      "unit": "px"
    },
    {
      "name": "margin-bottom",
      "class": "mb",
      "values": [ [".25em","_25em"],[".5em","_5em"],[".75em","_75em"],["1em","1em"],["1.25em","1_25em"],["1.5em","1_5em"],["1.75em","1_75em"],["2em","2em"] ]
    },
    {
      "name": "margin-left",
      "class": "ml",
      "values": [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,90,100,110,120],
      "unit": "px"
    },
    {
      "name": "margin-left",
      "class": "ml",
      "values": [ "auto"],
    },
    {
      "name": "margin-right",
      "class": "mr",
      "values": [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,90,100,110,120],
      "unit": "px"
    },
    {
      "name": "margin-right",
      "class": "mr",
      "values": [ "auto"],
    },
    {
      "name": "margin",
      "class": "m",
      "values": [0,10,20,30,35,40,45,50,55,60],
      "unit": "px"
    },
    {
      "name": ["margin-left","margin-right"],
      "class": "m-c",
      "values": ["auto","auto"]
    },
    //Padding
    {
      "name": "padding-top",
      "class": "pt",
      "values": defaultSizes,
      "unit": "px"
    },
    {
      "name": "padding-bottom",
      "class": "pb",
      "values": defaultSizes,
      "unit": "px"
    },
    {
      "name": "padding-left",
      "class": "pl",
      "values": [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,90,100,110,120,130,140,150],
      "unit": "px"
    },
    {
      "name": "padding-right",
      "class": "pr",
      "values": [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,90,100,110,120,130,140,150],
      "unit": "px"
    },
    {
      "name": "padding",
      "class": "p",
      "values": [0,10,20,30,35,40,45,50,55,60,70,80,90,100],
      "unit": "px"
    },
    //Width
    {
      "name": "width",
      "class": "w",
      "values": [ 0,["33.3333%","33"],"50%","100%",["25vw","25vw"],["50vw","50vw"],["100vw","100vw"] ]
    },
    {
      "name": "min-width",
      "class": "mnw",
      "values": [ 0,["33.3333%","33"],"50%","100%",["25vw","25vw"],["50vw","50vw"],["100vw","100vw"] ]
    },
    {
      "name": "max-width",
      "class": "mxw",
      "values": [ 0,["33.3333%","33"],"50%","100%",["25vw","25vw"],["50vw","50vw"],["100vw","100vw"],"250px","500px","550px","600px","650px","750px","800px","850px","1000px","1150px","1200px","1250px","1300px","1350px","1400px","1500px","1650px","1850px","2000px" ]
    },
    //Height
    {
      "name": "height",
      "class": "h",
      "values": [ ["0","0"],["33.3333%","33"],["50%","50"],["100%","100"],["25vh","25vh"],["50vh","50vh"],["100vh","100vh"], ]
    },
    {
      "name": "min-height",
      "class": "mnh",
      "values": [ ["0","0"],["33.3333%","33"],["50%","50"],["100%","100"],["25vh","25vh"],["50vh","50vh"],["100vh","100vh"], ]
    },
    {
      "name": "max-height",
      "class": "mxh",
      "values": [ ["0","0"],["33.3333%","33"],["50%","50"],["100%","100"],["25vh","25vh"],["50vh","50vh"],["100vh","100vh"], ]
    },
    //Display
    {
      "name": "display",
      "class": "d",
      "values": [ ["flex","flx"],["grid","grd"],["block","b"],["none","non"],["inline-flex","iflx"],["inline-block","ib"] ]
    },
    //Position
    {
      "name": "position",
      "class": "p",
      "values": ["absolute","relative","sticky","fixed","initial"]
    },
    {
      "name": "top",
      "class": "t",
      "values": [ 0,"50%","100%" ]
    },
    {
      "name": "bottom",
      "class": "b",
      "values": [ 0,"50%","100%" ]
    },
    {
      "name": "left",
      "class": "l",
      "values": [ 0,"50%","100%" ]
    },
    {
      "name": "right",
      "class": "r",
      "values": [ 0,"50%","100%" ]
    },
    //Transform
    {
      "name": "transform",
      "class": "tf",
      "values": [ "none",["-50%,-50%","c"],["0,-50%","yc"],["-50%,0","xc"] ]
    },
    {
      "name": "transform-x",
      "class": "tfx",
      "values": [ 0,"50%","100%",["-50%","n50"],["-100%","n100"] ]
    },
    {
      "name": "transform-y",
      "class": "tfy",
      "values": [ 0,"50%","100%",["-50%","n50"],["-100%","n100"] ]
    },
    //Transition
    {
      "name": "transition",
      "class": "ti",
      "values": [ 0,[".5","_5"],[".75","_75"],1,["1.25","1_25"],["1.5","1_5"],["1.75","1_75"],2 ],
      "unit": "s"
    },
    //Font
    {
      "name": "font-size",
      "class": "fs",
      "values": [10,11,12,13,14,15,16,18,20,21,22,23,24,25,26,28,30,32,34,36,38,40,42,44,45,46,48,50,52,54,55,56,58,60,62,65,70,80,90,100,110,120,140],
      "unit": "px"
    },
    {
      "name": "font-size",
      "class": "fs",
      "values": [ ["1em","1em"],["1.5em","1_5em"],["2em","2em"] ]
    },
    //Text
    {
      "name": "text-transform",
      "class": "tt",
      "values": ["uppercase","lowercase","capitalize","initial"]
    },
    {
      "name": "text-align",
      "class": "ta",
      "values": ["left","right","center"]
    },
    {
      "name": "line-height",
      "class": "lh",
      "values": [ 1,["1.15","1_15"],["1.25","1_25"],["1.5","1_5"],["1.75","1_75"],2 ]
    },
    {
      "name": "white-space",
      "class": "ws",
      "values": [ ["nowrap","nw"],"normal" ]
    },
    {
      "name": "letter-spacing",
      "class": "ls",
      "values": [ "1px","2px","3px","4px","5px" ]
    },
    //Images
    {
      "name": "object-fit",
      "class": "of",
      "values": [ ["cover","cv"],["contain","cn"] ]
    },
    {
      "name": "object-position",
      "class": "op",
      "values": ["left","center","right","top","bottom",["top left", "tl"],["top right","tr"],["bottom left","bl"],["bottom right","br"] ]
    },
    {
      "name": ["display","width","height","min-width","min-height","max-width","max-height","object-fit"],
      "class": "img-cv",
      "values": ["block","100%","100%","inherit","inherit","inherit","inherit","cover"],
    },
    {
      "name": ["display","width","height","min-width","min-height","max-width","max-height","object-fit"],
      "class": "img-cn",
      "values": ["block","100%","100%","inherit","inherit","inherit","inherit","contain"],
    },
    //Background
    {
      "name": "background-size",
      "class": "bs",
      "values": [ ["cover","cv"],["contain","cn"] ]
    },
    {
      "name": "background-repeat",
      "class": "br",
      "values": [ ["no-repeat", "nr"] ]
    },
    {
      "name": "background-position",
      "class": "bp",
      "values": ["left","center","right","top","bottom",["top left", "tl"],["top right","tr"],["bottom left","bl"],["bottom right","br"] ]
    },
    //Visibility
    {
      "name": "opacity",
      "class": "op",
      "values": [ 0,[".25","25"],[".5","5"],[".75","75"],1 ]
    },
    {
      "name": "visibility",
      "class": "v",
      "values": [ ["hidden","visible"] ]
    },
    {
      "name": ["visibility","opacity"],
      "class": "vis-h",
      "values": ["hidden","0"]
    },
    {
      "name": ["clip","clip-path","height","overflow","position","white-space","width"],
      "class": "screenreader",
      "values": ["rect(0 0 0 0)","inset(50%)","1px","hidden","absolute","nowrap","1px"]
    },
    //Overflow
    {
      "name": "overflow",
      "class": "of",
      "values": ["hidden","visible","auto"]
    },
    //Border
    {
      "name": "border-radius",
      "class": "br",
      "values": [ ["50%","50"],["5px",5] ]
    },
    //Z-Index
    {
      "name": "z-index",
      "class": "zi",
      "values": [0,1,2]
    },
    //Flex
    {
      "name": ["justify-content", "align-items"],
      "class": "flx-c",
      "values": ["center", "center"]
    },
    {
      "name": "flex-direction",
      "class": "fd",
      "values": [ ["column","c"],["column-reverse","cr"],["row-reverse","rr"] ],
    },
    {
      "name": "justify-content",
      "class": "jc",
      "values": [ ["center","c"],["flex-start","fs"],["flex-end","fe"],["space-around","sa"],["space-between","sb"] ]
    },
    {
      "name": "align-items",
      "class": "ai",
      "values": [ ["center","c"],["flex-start","fs"],["flex-end","fe"] ],
    },
    {
      "name": "flex-wrap",
      "class": "fw-w",
      "values": "wrap",
    },
    {
      "name": "flex-basis",
      "class": "d-flx.col",
      "values": [ [100,"1"],[50,"2"],["33.3333","3"],[25,"4"],[20,"5"],["16.6666","6"] ],
      "unit": "%",
      "childSelector": ">*",
    },
    //Grid
    {
      "name": "grid-template-columns",
      "class": "d-grd.col",
      "values": [ ["1fr","1"],["1fr 1fr","2"],["repeat(3, 1fr)","3"],["repeat(4, 1fr)","4"],["repeat(5, 1fr)","5"],["repeat(6, 1fr)","6"],["repeat(7, 1fr)","7"],["repeat(8, 1fr)","8"],["repeat(9, 1fr)","9"],["repeat(10, 1fr)","10"],["repeat(11, 1fr)","11"],["repeat(12, 1fr)","12"] ],
    },
    {
      "name": "grid-gap",
      "class": "gg",
      "values": [0,5,10,15,20,25,30,35,40,45,50,55,60,65,70],
      "unit": "px"
    },
    {
      "name": "grid-gap",
      "class": "gg",
      "values": [ ["2%","5p"],["2.5%","2_5p"],["3%","3p"],["4%","4p"],["5%","5p"],["10%","10p"],["15%","15p"],["20%","20p"] ]
    },
    //Position
    {
      "name": ["position","top","left","width","height"],
      "class": "abs-cv",
      "values": ["absolute","0","0","100%","100%"]
    },
    {
      "name": ["position","top","left","transform"],
      "class": "abs-c",
      "values": ["absolute","50%","50%","translate(-50%,-50%)"]
    }
  ];
  
  
  //Init
  renderCSS();
  
  //Functions
  function renderCSS() {
    var css = '',
        styleTag = document.createElement('style'); 
    
    styleTag.type = 'text/css';
    styleTag.className = 'helper-classes';
  
    //Loop through media queries to add helper classes
    for (var i=0;i<mediaQueries.length;i++) {
      var media = mediaQueries[i],
          cssString = '';
      
      //Loop through the properties to build out classes
      for (var x=0;x<properties.length;x++) {
        var _this = properties[x];
        cssString += getHelperClasses(_this, media);
      }
  
      //If not default then nest classes inside media query
      if (media.query != false) {
        cssString = `@media ${media.query} { ${cssString} }`;
      }
      //Add to main CSS string
      css += cssString + '\r\n';//add line break (optional)
    
    }
  
    if (styleTag.styleSheet)  {
      styleTag.styleSheet.cssText = css.trim(); 
    }
    else  {
      styleTag.appendChild(document.createTextNode(css.trim()));
    }
  
    //Output CSS to document
    document.getElementsByTagName("head")[0].appendChild(styleTag);
  }
  function getHelperClasses(property, media) {
    var propertyName = property.name || false,
        className = property.class || false,
        unit = property.unit || '',
        prefix = property.prefix || '',
        mediaSuffix = media.suffix || '',
        childSelector = property.childSelector || '',
        values = property.values || false,
        //combinator = property.combinator || false,
        //valuePrefix = property.valuePrefix || false,
        selector = `.${className}${mediaSuffix}${childSelector}`,
        cssString = '',
        styles = '';
    if (!values || !propertyName || !className ) { return ''; }
  
    //If multiple property names/values for this one class
    if (Array.isArray(propertyName)) {
      for (var i=0;i<propertyName.length;i++) {
        var propName = propertyName[i];
        styles += `${propName}:${values[i]};`;
      }
      cssString += getCSSRule(selector, styles);
    }
    //Single property item
    else {
      //If multiple values (array)
      if (Array.isArray(values)) {
        for (var i=0;i<values.length;i++) {
          var _val = values[i],
              value = (Array.isArray(_val)) ? _val[0] : _val,
              suffix = (Array.isArray(_val)) ? _val[1] : (!isNaN(parseInt(_val))) ? parseInt(_val) : _val.toString().substring(0, 1);//if this is not an array and this is a string then use first letter as suffix
          
          styles = `${propertyName}:${value}${unit};`;
          selector = `.${className}-${suffix}${mediaSuffix}${childSelector}`;
          cssString += getCSSRule(selector, styles);
        }
      }
      //One value (string)
      else if (values != '') {
        styles = `${propertyName}:${values};`;
        cssString += getCSSRule(selector, styles);
      }
    }
    
    return cssString;
  }
  function getCSSRule(selector, styles) {
    return `${selector} {${styles}}`;
  }
  
  });//.ready
  
  
  /**
    //Example
    {
      "name": "",
      "class": "",
      "values": []
    },
    
  */
  