document.getElementById("blogForm").addEventListener("submit", function (e) {
  const title = document.getElementById("title").value.trim();
  const description = document.getElementById("description").value.trim();
  const category = document.getElementById("category").value;

  if (!title || !description || !category) {
    alert("Please fill out all fields!");
    e.preventDefault();
  }
});
