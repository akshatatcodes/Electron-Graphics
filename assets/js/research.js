/* Graphic Design Research Details Table */

const researchTable = document.querySelector(".main");

const research = [
  {
    title: "Exploring the Impact of Minimalist Design on User Experience",
    authors: "Jane Doe, John Smith, Emily Johnson",
    conferences: "International Conference on Graphic Design and UX",
    researchYr: 2023,
    citebox: "popup1",
    image: "assets/images/research-page/minimalistDesign.png",
    citation: {
      vancouver: "Jane Doe, John Smith, Emily Johnson. Exploring the Impact of Minimalist Design on User Experience. International Conference on Graphic Design and UX 2023.",
    },
    abstract: "This study investigates how minimalist design principles influence user engagement and overall satisfaction in digital interfaces.",
    absbox: "absPopup1",
  },

  {
    title: "The Role of Color Theory in Branding and Identity Design",
    authors: "Michael Brown, Lisa White, Sarah Lee",
    conferences: "Design and Branding Conference",
    researchYr: 2022,
    citebox: "popup2",
    image: "assets/images/research-page/colorTheory.png",
    citation: {
      vancouver: "Michael Brown, Lisa White, Sarah Lee. The Role of Color Theory in Branding and Identity Design. Design and Branding Conference 2022.",
    },
    abstract: "This research examines how different color schemes affect brand perception and identity in marketing materials.",
    absbox: "absPopup2",
  },

  {
    title: "Analyzing the Effectiveness of Responsive Design in Modern Websites",
    authors: "Laura Green, Kevin Black, Amanda Wright",
    conferences: "Web Design Innovations Symposium",
    researchYr: 2023,
    citebox: "popup3",
    image: "assets/images/research-page/responsiveDesign.png",
    citation: {
      vancouver: "Laura Green, Kevin Black, Amanda Wright. Analyzing the Effectiveness of Responsive Design in Modern Websites. Web Design Innovations Symposium 2023.",
    },
    abstract: "This paper explores how responsive design practices impact user accessibility and engagement across various devices and screen sizes.",
    absbox: "absPopup3",
  },

  {
    title: "Trends in Typography: From Print to Digital",
    authors: "Steven Adams, Rachel Moore, Daniel Harris",
    conferences: "Typography and Digital Media Conference",
    researchYr: 2022,
    citebox: "popup4",
    image: "assets/images/research-page/typographyTrends.png",
    citation: {
      vancouver: "Steven Adams, Rachel Moore, Daniel Harris. Trends in Typography: From Print to Digital. Typography and Digital Media Conference 2022.",
    },
    abstract: "This research tracks the evolution of typography trends as they transition from traditional print media to digital platforms.",
    absbox: "absPopup4",
  },

  {
    title: "User-Centered Design: Enhancing Interfaces Through User Feedback",
    authors: "Olivia Scott, James Clark, Natalie Evans",
    conferences: "User Experience Design Summit",
    researchYr: 2023,
    citebox: "popup5",
    image: "assets/images/research-page/userCenteredDesign.png",
    citation: {
      vancouver: "Olivia Scott, James Clark, Natalie Evans. User-Centered Design: Enhancing Interfaces Through User Feedback. User Experience Design Summit 2023.",
    },
    abstract: "This study focuses on how incorporating user feedback into design processes can significantly improve interface usability and effectiveness.",
    absbox: "absPopup5",
  },

  {
    title: "The Intersection of Graphic Design and Digital Art",
    authors: "Anna Lee, Mark Johnson, Emma Brown",
    conferences: "Digital Art and Design Conference",
    researchYr: 2023,
    citebox: "popup6",
    image: "assets/images/research-page/graphicDesignArt.png",
    citation: {
      vancouver: "Anna Lee, Mark Johnson, Emma Brown. The Intersection of Graphic Design and Digital Art. Digital Art and Design Conference 2023.",
    },
    abstract: "This paper explores the convergence of graphic design and digital art, highlighting new trends and collaborative approaches in the creative industry.",
    absbox: "absPopup6",
  },

  {
    title: "Innovations in Motion Graphics for Digital Advertising",
    authors: "Sophia Carter, Andrew Wilson, Jessica White",
    conferences: "Motion Graphics and Advertising Symposium",
    researchYr: 2022,
    citebox: "popup7",
    image: "assets/images/research-page/motionGraphics.png",
    citation: {
      vancouver: "Sophia Carter, Andrew Wilson, Jessica White. Innovations in Motion Graphics for Digital Advertising. Motion Graphics and Advertising Symposium 2022.",
    },
    abstract: "This research delves into the latest innovations in motion graphics and their impact on effectiveness in digital advertising campaigns.",
    absbox: "absPopup7",
  },
];

AOS.init();
const fillData = () => {
  let output = "";
  research.forEach(
    ({
      image,
      title,
      authors,
      conferences,
      researchYr,
      citebox,
      citation,
      absbox,
      abstract,
    }) =>
      (output += `
            <tr data-aos="zoom-in-left"> 
                <td class="imgCol"><img src="${image}" class="rImg"></td>
                <td class="researchTitleName">
                    <div class="img-div">
                        <span class="imgResponsive">
                            <img src="${image}" class="imgRes">
                        </span>
                    </div>
                    <a href="#0" class="paperTitle"> ${title} </a> 
                    <div class="authors"> ${authors} </div> 
                    
                    <div class="rConferences"> ${conferences} 
                        <div class="researchY">${researchYr}</div>
                    </div>
                    
                    <!--CITE BUTTON-->
                    <div class="d-flex" style="margin-right:5%;">
                        <button class="button button-accent button-small text-right button-abstract" type="button" data-toggle="collapse" data-target="#${absbox}" aria-expanded="false" aria-controls="${absbox}">
                            ABSTRACT
                        </button>
                
                        <button class="button button-accent button-small text-right button-abstract" type="button" data-toggle="collapse" data-target="#${citebox}" aria-expanded="false" aria-controls="${citebox}">
                            CITE
                        </button>
                    </div>
                    <div id="${absbox}" class="collapse" aria-labelledby="headingTwo" data-parent=".collapse">
                        <div class="card-body">
                            ${abstract}    
                        </div>
                    </div>
                    <div id="${citebox}" class="collapse" aria-labelledby="headingTwo" data-parent=".collapse">
                        <div class="card-body">
                            ${citation.vancouver}    
                        </div>
                    </div>
                </td>
            </tr>`)
  );
  researchTable.innerHTML = output;
};
document.addEventListener("DOMContentLoaded", fillData);
