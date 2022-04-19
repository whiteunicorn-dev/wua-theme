export default function unescapeHtml(text)  {
    return text.replace(/&amp;/g,"&")
               .replace(/&lt;/g,"<")
               .replace(/&gt;/g,">")
               .replace(/&quot;/g,'"')
               .replace(/&#39;/g,"'");
}