function markdownHelp () {
  newwindow=window.open('/markdown','Mardown Help','height=600,width=600');
  if (window.focus) {newwindow.focus()}
  return false;
}