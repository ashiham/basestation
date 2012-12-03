      /* Style current page link */
      jQuery(document).ready(function(){
        //jQuery("div.pagination").children("ul").children("li").addClass("active");
        //jQuery("div.pagination").children("ul").children("li:not(:has(a))").addClass("active");
        jQuery("ul.pagination").children("li:not(:has(a))").addClass("current");
      });