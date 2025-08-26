const projectCardsContainer = document.getElementById("projectCardsContainer");

// Sample projects array (Make sure this reflects your actual data)
const projects = [
    {
        title: "Infola Logo",
        cardImage: "assets/images/project-page/quiz.jpg",
        description: "Infolo logo created using Adobe Illustrator.",
        tagimg: "https://cdn.iconscout.com/icon/free/png-512/react-1-282599.png"
    },
    // Add more projects here...
];

// Function to render project cards
function renderProjectCards() {
    projectCardsContainer.innerHTML = ""; // Clear the container
    projects.forEach((project) => {
        const card = document.createElement("div");
        card.classList.add("project-card");
        card.innerHTML = `
            <img src="${project.cardImage}" alt="${project.title}">
            <h3>${project.title}</h3>
            <p>${project.description}</p>
            <img src="${project.tagimg}" alt="Tag Image" class="tag-img">
        `;
        projectCardsContainer.appendChild(card);
    });
}

// Call the render function to display the projects
renderProjectCards();
