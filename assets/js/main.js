function paginate(start, pageNumber, ajaxUrl) {
  console.log(ajaxUrl);
  jQuery("#post-loader-spinner").removeClass("element-none");
  jQuery.ajax({
    type: "POST",
    url: ajaxUrl,
    data: {
      action: "paginatePosts",
      start: start,
    },
    success: function (data) {
      jQuery("#single-posts-rendered").html(data);
      jQuery(".paginations-links").removeClass("active");
      jQuery("#page-" + pageNumber).addClass("active");
      jQuery("#post-loader-spinner").addClass("element-none");
      document.querySelector("#single-posts-rendered").scrollIntoView({
        behavior: "smooth",
      });
    },
  });
}

document.addEventListener("DOMContentLoaded", (event) => {
  const search = document.getElementById("search-whole-site");
  if (search) {
    search.addEventListener("keyup", ({ key }) => {
      console.log(key);
      if (key === "Enter") {
        var searchText = search.value;
        searchText = searchText.replace(/\s+/g, "-");
        location.href = jQuery("#site-url-input").val() + "/?s=" + searchText;
      }
    });
    document
      .getElementById("clicked_search_icon")
      .addEventListener("click", function () {
        var searchText = search.value;
        searchText = searchText.replace(/\s+/g, "-");
        location.href = jQuery("#site-url-input").val() + "/?s=" + searchText;
      });
  }
});
