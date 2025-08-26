function togglePanel(panelId) {
    const panel = document.getElementById(panelId);
    if (panel.style.display === "none" || panel.style.display === "") {
        panel.style.display = "block";
    } else {
        panel.style.display = "none";
    }
}
