export default function parseJSON(json, debug = true) {
    let parsed = false;
  
    try {
        parsed = JSON.parse(json);
    }
    catch (e) {
      if (debug) console.log("there was an error parsing this JSON string", json);
    }
  
    return parsed;
}