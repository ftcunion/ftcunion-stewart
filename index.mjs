import { readFileSync, writeFileSync } from "fs";
import { minify } from "minify";
import svgToTinyDataUri from "mini-svg-data-uri";

const inputCSSFile = "style.css";
const outputCSSFile = "style.min.css";

// Read style.css
const input_css = readFileSync(inputCSSFile, "utf8");

// Keep a copy of the original CSS for output
var output_css = input_css;

// Find any SVG url() in the CSS
const svgRegex = /url\(['"]?([^'")]+\.svg)['"]?\)/g;

// Read SVG filename from capture group 1 and convert to tiny data URI
for (const match of input_css.matchAll(svgRegex)) {
  const svgUrl = match[1];
  console.log(`Inlining SVG: ${svgUrl}`);

  // Read the SVG file
  const svgContent = readFileSync(svgUrl, "utf8");

  // Convert SVG to tiny data URI
  const tinyDataUri = svgToTinyDataUri(svgContent);

  // Replace the SVG URL in the CSS with the tiny data URI
  output_css = output_css.replace(match[0], `url("${tinyDataUri}")`);
}

// Minify the CSS
minify.css(output_css).then((minifiedCss) => {
  writeFileSync(outputCSSFile, minifiedCss);
  console.log(`Minified CSS saved to ${outputCSSFile}`);
});
