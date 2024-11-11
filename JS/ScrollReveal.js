const sr = ScrollReveal({
  origin: "top",
  distance: "50px",
  duration: 1000,
  reset: false,
});

// Global
sr.reveal(".hero", {
  duration: 1000,
  interval: 100,
});

sr.reveal(".floater-body", {
  duration: 1000,
  interval: 100,
  delay: 500,
});

sr.reveal(".floaters", {
  duration: 1000,
  interval: 100,
  delay: 100,
});

sr.reveal(".product-card-con", {
  duration: 1000,
  interval: 100,
});
