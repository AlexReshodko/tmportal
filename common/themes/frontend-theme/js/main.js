$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

var Utils = {
    getID: function(str){
        return parseInt(str.replace(/[^0-9\.]/g, ''), 10);
    }
}