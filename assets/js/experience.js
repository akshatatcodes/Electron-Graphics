AOS.init();

//  Work experience cards

const experiencecards = document.querySelector(".experience-cards");
const exp = [
  {
    title: "Graphic Design Intern",
    cardImage: "assets/images/experience-page/flipkart.jpg", 
    place: "Creative Agency",
    time: "(Jan, 2022 - Dec, 2022)",
    desp: "<li>Collaborated with senior designers to create visual concepts for marketing campaigns.</li> <li>Designed digital and print media including social media posts, brochures, and advertisements.</li> <li>Assisted in brand identity development and logo design for various clients.</li>",
  },
  {
    title: "Freelance Graphic Designer",
    cardImage: "assets/images/experience-page/gsoc.png", 
    place: "Freelance",
    time: "(Jan, 2021)",
    desp: "<li>Designed logos, business cards, and promotional materials for startups and small businesses.</li><li>Worked closely with clients to ensure their vision was translated into visually appealing designs.</li><li>Provided branding consultation and creative direction for digital media projects.</li>",
  },
  {
    title: "Design Assistant",
    cardImage: "assets/images/experience-page/IIT_Bombay.jpg", 
    place: "Design Studio",
    time: "(Jun, 2020 - Dec, 2020)",
    desp: "<li>Supported lead designers in creating mood boards, mockups, and final design assets.</li><li>Worked on packaging design, editorial layouts, and print production.</li><li>Contributed to brainstorming sessions and helped with project management.</li>",
  },
];

const showCards2 = () => {
  let output = "";
  exp.forEach(
    ({ title, cardImage, place, time, desp }) =>
      (output +=         
    `<div class="col gaap" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="100" data-aos-duration="400"> 
      <div class="card card1">
        <img src="${cardImage}" class="featured-image"/>
        <article class="card-body">
          <header>
            <div class="title">
              <h3>${title}</h3>
            </div>
            <p class="meta">
              <span class="pre-heading">${place}</span><br>
              <span class="author">${time}</span>
            </p>
            <ol>
              ${desp}
            </ol>
          </header>
        </article>
      </div>
    </div>`
      )
  );
  experiencecards.innerHTML = output;
};
document.addEventListener("DOMContentLoaded", showCards2);

// Volunteership Cards

const volunteership = document.querySelector(".volunteership");
const volunteershipcards = [
  {
    title: "Design Mentor at Creative Camp 2021",
    cardImage: "assets/images/experience-page/1.jpg", 
    description:
      "Guided young designers in developing their design skills through workshops and one-on-one sessions.",
  },
  {
    title: "Graphic Design Lead at ArtX 2020",
    cardImage: "assets/images/experience-page/2.jpg", 
    description:
      "Led a team of designers to create promotional materials for an online art exhibition.",
  },
  {
    title: "Volunteer Designer for Charity Run",
    cardImage: "assets/images/experience-page/3.jpg", 
    description:
      "Designed event posters, banners, and social media assets to promote a charity run event.",
  },
  {
    title: "Design Mentor for Code/Art 2021",
    cardImage: "assets/images/experience-page/4.jpg", 
    description:
      "Mentored participants in creating digital art and graphics for a coding and design competition.",
  },
];

const showCards = () => {
  let output = "";
  volunteershipcards.forEach(
    ({ title, cardImage, description }) =>
      (output +=         
      `<div class="card volunteerCard" data-aos="fade-down" data-aos-easing="linear" data-aos-delay="100" data-aos-duration="600" style="height: 550px;width:400px">
        <img src="${cardImage}" height="250" width="65" class="card-img" style="border-radius:10px">
        <div class="content">
            <h2 class="volunteerTitle">${title}</h2><br>
            <p class="copy">${description}</p></div>
      </div>`
      )
  );
  volunteership.innerHTML = output;
};
document.addEventListener("DOMContentLoaded", showCards);

// Hackathon Section

const hackathonsection = document.querySelector(".hackathon-section");
const mentor = [
  {
    title: "Design Sprint Hackathon",
    subtitle: "Mentor",
    image: "assets/images/experience-page/uplift.png", 
    desp: "Mentored participants in creating visually compelling digital products during a design sprint hackathon.",
    href: "https://example.com/designsprint",
  },
  {
    title: "Creative Code Fest",
    subtitle: "Judge",
    image: "assets/images/experience-page/ulhacks.png", 
    desp: "Judged design and development projects submitted by students in a 48-hour creative coding hackathon.",
    href: "https://example.com/creativecodefest",
  },
  {
    title: "UX/UI Hackathon",
    subtitle: "Judge",
    image: "assets/images/experience-page/wafflehacks.png", 
    desp: "Reviewed and evaluated UX/UI designs aimed at improving accessibility and user experience.",
    href: "https://example.com/uxhackathon",
  },
  {
    title: "Art Tech Summit",
    subtitle: "Mentor",
    image: "assets/images/experience-page/elevate.png", 
    desp: "Mentored young creatives on the intersection of art and technology at a global summit.",
    href: "https://example.com/arttechsummit",
  },
];

const showCards3 = () => {
  let output = "";
  mentor.forEach(
    ({ title, image, subtitle, desp, href }) =>
      (output +=   
      `<div class="blog-slider__item swiper-slide">
        <div class="blog-slider__img">
            <img src="${image}" alt="">
        </div>
        <div class="blog-slider__content">
          <div class="blog-slider__title">${title}</div>
          <span class="blog-slider__code">${subtitle}</span>
          <div class="blog-slider__text">${desp}</div>
          <a href="${href}" class="blog-slider__button">Read More</a>   
        </div>
      </div>`
      )
  );
  hackathonsection.innerHTML = output;
};
document.addEventListener("DOMContentLoaded", showCards3);
