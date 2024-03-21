document.addEventListener("DOMContentLoaded", () => {
    var editor = CodeMirror.fromTextArea(
      document.getElementById("resume_json"),
      {
        lineNumbers: true,
        mode: "application/json",
      }
    );
    editor.setSize(null, 500);

    const shortcode = document.querySelector(".resume-shortcode");
    const shortcodeMessage = document.querySelector(".is-copied");

    shortcode.addEventListener("click", () => {
      console.log(shortcode.textContent);
      navigator.clipboard.writeText(shortcode.textContent);
      shortcode.style.color = "green";
      shortcode.style.backgroundColor = "#d2f7d2";
      shortcodeMessage.textContent = "Shortcode copiado!";
      shortcodeMessage.style.fontWeight = "600";
      shortcodeMessage.style.color = "green";
    });
});