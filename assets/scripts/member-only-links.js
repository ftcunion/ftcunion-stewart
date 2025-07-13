// Check if "member-access-url" is set in the localStorage
(function () {
  const currentUrl = new URL(document.location.href);

  function constructIntendedUrl(routeUrl, storedQuery) {
    // If there is an "intended_path" query parameter, go there
    intendedUrl = new URL(
      routeUrl.searchParams.get("intended_path"),
      document.location.origin
    );
    // Add the "val" and "sig" query parameters to the intended URL
    intendedUrl.searchParams.set("val", storedQuery.value);
    intendedUrl.searchParams.set("sig", storedQuery.signature);
    intendedUrl.searchParams.set("iam", storedQuery.iam);

    return intendedUrl.href;
  }

  // Process for /members/ pages
  if (
    currentUrl.pathname.startsWith("/members/") &&
    currentUrl.searchParams.has("val") &&
    currentUrl.searchParams.has("sig") &&
    currentUrl.searchParams.has("iam")
  ) {
    if (currentUrl.pathname === "/members/") {
      // If we are on the members page, save the current URL to localStorage
      localStorage.setItem("member-access-url", currentUrl.href);
    }
    // If we are on any /members/* page, remove the query parameters from the address bar
    const newUrl = new URL(currentUrl.href);
    newUrl.searchParams.delete("val");
    newUrl.searchParams.delete("sig");
    newUrl.searchParams.delete("iam");
    // Update the URL without reloading the page
    history.replaceState({}, "", newUrl.href);
  }

  // Process for login page and navigation links
  if (localStorage.getItem("member-access-url")) {
    // Check if the val query parameter is in the future
    const storedUrl = new URL(localStorage.getItem("member-access-url"));
    const storedQuery = {
      value: storedUrl.searchParams.get("val"),
      signature: storedUrl.searchParams.get("sig"),
      iam: storedUrl.searchParams.get("iam"),
    };

    if (
      storedQuery.signature &&
      storedQuery.value &&
      !currentUrl.searchParams.has("error")
    ) {
      if (
        currentUrl.pathname === "/member-login/" &&
        currentUrl.searchParams.has("intended_path")
      ) {
        // If the current URL is member-login and has an intended_path, redirect to that path
        window.location.replace(constructIntendedUrl(currentUrl, storedQuery));
      } else {
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
                link.href = constructIntendedUrl(linkUrl, storedQuery);
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
