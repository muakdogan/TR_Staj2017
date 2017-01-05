// Select the main list and add the class "hasSubmenu" in each LI that contains an UL
$('ul').each(function(){
  $this = $(this);
  $this.find("li").has("ul").addClass("hasSubmenu");
});
// Find the last li in each level
$('li:last-child').each(function(){
  $this = $(this);
  // Check if LI has children
  if ($this.children('ul').length === 0){
    // Add border-left in every UL where the last LI has not children
    $this.closest('ul').css("border-left", "1px solid gray");
  } else {
    // Add border in child LI, except in the last one
    $this.closest('ul').children("li").not(":last").css("border-left","1px solid gray");
    // Add the class "addBorderBefore" to create the pseudo-element :defore in the last li
    $this.closest('ul').children("li").last().children("a").addClass("addBorderBefore");
    // Add margin in the first level of the list
    $this.closest('ul').css("margin-top","20px");
    // Add margin in other levels of the list
    $this.closest('ul').find("li").children("ul").css("margin-top","20px");
  };
});
// Add bold in li and levels above
$('ul li').each(function(){
  $this = $(this);
  $this.mouseenter(function(){
    $( this ).children("a").css({"font-weight":"bold","color":"#336b9b"});
  });
  $this.mouseleave(function(){
    $( this ).children("a").css({"font-weight":"normal","color":"#428bca"});
  });
});
// Add button to expand and condense - Using FontAwesome
$('ul li.hasSubmenu').each(function(){
  $this = $(this);
  $this.prepend("<a href='#'><i style='display:none;' class='fa fa-minus-circle'></i><i  class='fa fa-plus-circle'></i></a>");
  $this.children("a").not(":last").removeClass().addClass("toogle");
  $this.closest("li").children("ul").toggle("slow");
  $this.children("i").toggle();
});
// Actions to expand and consense
$('ul li.hasSubmenu a.toogle').click(function(){
  console.log("girdi");
  $this = $(this);
  $this.closest("li").children("ul").toggle("slow");
  $this.children("i").toggle();
  
  var levelChange=$this.next().next().attr("id");
  var id = $this.next().children().next().attr("id");
  jQuery.ajax({
      type: "GET",
      url:"findChildrenTree",
      data:{id:id},
      success: function(data){
          console.log("level "+levelChange);
          console.log("id "+id);
          console.log(data);
           var ul = document.getElementById(levelChange);
            
          for(var i=0; i< data.length ; i++){
              
            var li = document.createElement("li");
            var a2 = document.createElement("a");
            a2.setAttribute("href","#");
            a2.setAttribute("class","toggle");
            var i1=document.createElement("i");
            i1.setAttribute("style","display:none;");
            i1.setAttribute("class","fa fa-minus-circle");
            a2.appendChild(i1);
            var i2=document.createElement("i");
            i2.setAttribute("class","fa fa-plus-circle");
            a2.appendChild(i2);
            li.appendChild(a2);
            var a = document.createElement("a");
            a.setAttribute("href","#");
            a.appendChild(document.createTextNode(data[i].adi+"    "));
            var checkbox = document.createElement("input");
            checkbox.setAttribute("type","checkbox");
            checkbox.setAttribute("id",data[i].id);
            a.appendChild(document.createTextNode("    "));
            a.appendChild(checkbox);
            var text = document.createElement("input");
            text.setAttribute("type","text");
            text.setAttribute("id",data[i].id);
            text.setAttribute("value",data[i].nace_kodu);
            
            a.appendChild(text);
            var ul2 = document.createElement("ul");
            li.setAttribute("class","hasSubmenu");
            li.setAttribute("style","border-left: 1px solid gray;");
            li.appendChild(a);
            li.appendChild(ul2);
            ul.appendChild(li);
           }
           
      }
  });
 
  return false;
});
$('ul li.hasSubmenu a.toggle').click(function(){
  
  console.log("girdi");
  $this = $(this);
  $this.closest("li").children("ul").toggle("slow");
  $this.children("i").toggle();
  
  return false;
});