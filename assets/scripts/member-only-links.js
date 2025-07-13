// Check if "member-access-url" is set in the localStorage
(function () {
  if (localStorage.getItem("member-access-url")) {
    // Check if the val query parameter is in the future
    const url = new URL(localStorage.getItem("member-access-url"));
    const value = url.searchParams.get("val");
    const signature = url.searchParams.get("sig");
    const iam = url.searchParams.get("iam");
    const currentUrl = new URL(document.location.href);
    if (signature && value && !currentUrl.searchParams.has("error")) {
      function constructIntendedUrl(routeUrl) {
        // If there is an "intended_path" query parameter, go there
        intendedUrl = new URL(
          routeUrl.searchParams.get("intended_path"),
          document.location.origin
        );
        // Add the "val" and "sig" query parameters to the intended URL
        intendedUrl.searchParams.set("val", value);
        intendedUrl.searchParams.set("sig", signature);
        intendedUrl.searchParams.set("iam", iam);

        return intendedUrl.href;
      }

      if (
        currentUrl.pathname === "/member-login/" &&
        currentUrl.searchParams.has("intended_path")
      ) {
        // If the current URL is member-login and has an intended_path, redirect to that path
        window.location.replace(constructIntendedUrl(currentUrl));
      } else {
        // If we are on a /members/* page, remove the query parameters from the address bar
        if (
          currentUrl.pathname.startsWith("/members/") &&
          currentUrl.searchParams.has("val") &&
          currentUrl.searchParams.has("sig") &&
          currentUrl.searchParams.has("iam")
        ) {
          const newUrl = new URL(currentUrl.href);
          newUrl.searchParams.delete("val");
          newUrl.searchParams.delete("sig");
          newUrl.searchParams.delete("iam");
          // Update the URL without reloading the page
          history.replaceState({}, "", newUrl.href);
        }
        // Run on DOMContentLoaded to ensure all links are available
        document.addEventListener("DOMContentLoaded", () => {
          // Replace the navigation link with the intended URL
          const navigationLink = document.querySelectorAll(
            ".member-access-link a"
          );
          if (navigationLink) {
            navigationLink.forEach((link) => {
              const linkUrl = new URL(link.href);
              if (
                linkUrl.pathname === "/member-login/" &&
                linkUrl.searchParams.has("intended_path")
              ) {
                link.href = constructIntendedUrl(linkUrl);
              }
            });
          }
        });
      }
    } else {
      // If the value is in the past or is invalid, remove the URL from localStorage
      localStorage.removeItem("member-access-url");
    }
  }
})();
