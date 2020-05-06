var session = '<%=Session["user"] != null%>';
if(session!=null){
	var x = document.getElementById("logged");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
else{
	var x = document.getElementById("unlogged");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}