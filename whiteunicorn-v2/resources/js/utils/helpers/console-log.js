//-- Console Log Shortcut --//
export default function log() {/* jshint -W021 */
    if(window.console){if(Function.prototype.bind)log=Function.prototype.bind.call(console.log,console);else log=function(){Function.prototype.apply.call(console.log,console,arguments);};log.apply(this,arguments);}
}