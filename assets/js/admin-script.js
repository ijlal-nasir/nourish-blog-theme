function tabChange(linkTo) {
  if (linkTo == "#theme-options-header-section") {
    document
      .querySelector("#theme-options-top-banner-section")
      .classList.add("element-none");
    document.querySelector(linkTo).classList.remove("element-none");
    document
      .querySelectorAll(".theme-vertical-tab-list-item")[1]
      .classList.remove("active-tab");
    document
      .querySelectorAll(".theme-vertical-tab-list-item")[0]
      .classList.add("active-tab");
    document.querySelector("#selected-section-heading").innerHTML =
      "Header Settings";
  } else {
    document
      .querySelector("#theme-options-header-section")
      .classList.add("element-none");
    document.querySelector(linkTo).classList.remove("element-none");
    document
      .querySelectorAll(".theme-vertical-tab-list-item")[0]
      .classList.remove("active-tab");
    document
      .querySelectorAll(".theme-vertical-tab-list-item")[1]
      .classList.add("active-tab");
    document.querySelector("#selected-section-heading").innerHTML =
      "Site Banner Settings";
  }
}
document.addEventListener("DOMContentLoaded", () => {
  var upload_button = document.querySelector("#upload_site_logo");
  upload_button.addEventListener("click", function () {
    var file = wp
      .media({
        title: "Upload Logo",
        multiple: false,
      })
      .open()
      .on("select", function (e) {
        var uploaded_file = file.state().get("selection").first();
        var file_url = uploaded_file.toJSON().url;
        document
          .querySelector("#uploaded_site_logo")
          .setAttribute("src", file_url);
        document
          .querySelector("#site-header-logo")
          .setAttribute("value", file_url);
      });
  });
});
