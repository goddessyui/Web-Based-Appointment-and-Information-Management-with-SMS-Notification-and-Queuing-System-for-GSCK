<?php
include("header.php");
?>

<div class="about_container">

    <div class="about_section">
        <div class="left_first_section">
            <h2>History of Goldenstate College</h2>

            <p>
                Demand for technical skills by the economic sector was growing. The Goldenstate Institute, aggressive to respond to
                this need, offered short-term industrial courses.
            </p>

            <p>
                When it opened, the institution was manned by only seven administrative officials, twenty-nine instructors, 
                and 160 students. Five years later, the administrative staff and instructors increased to forty-eight. Their efforts 
                and expertise were dedicated to meet the needs of the increasing student population.
            </p>

            <p>
                In the year 1997, the Goldenstate Institute occupied two building spaces which became the venues for academic training, and 
                specific practicum and classroom instructions. The institution started its operation with only 7 vocational courses 
                and 5 non-formal courses. The same courses were offered with two more additional courses: Computer Secretarial and
                Architectural Drafting.
            </p>

            <p>
                With the increasing demand for supply of technically-skilled men and women here and abroad, Goldenstate continues to 
                upgrade and enhance its training program proficiency in order to produce graduates who can be productive and efficient 
                in the professional world. This, along with fulfilling its educational mission in nation building, 
                is the guiding philosophy of the Goldenstate Institute as it envisions a society where constituents live fruitfully and
                productively within the context of an economically productive society. In the year 2001, the Board of Trustees decided to
                change its organization's name from Goldenstate Institute, Inc to Goldenstate College, Inc and applied degree courses
                from the Commission of Higher Education. Fortunately, the school was granted permit to operate Bachelor of Science in Tourism,
                Bachelor of Science in Hotel and Restaurant Management, and Bachelor of Science Commerce, Major in Business Management.
                In 2006, the Goldenstate College was fortunately granted permit to operate Bachelor of Science in Business 
                Administration and BS Tourism.
            </p>
            <p>
                Currently, the Goldenstate College of Koronadal offers a variety of courses including BSHM, BSTM, BSIT, BSSW, ABE, 
                BECE, BTVED, BSBA, ACT, HM, and TESDA PROGRAMs.
            </p>
        </div>
        <div class="credentials"></div>
    </div>

    <div class="img_section"></div>

    <div class="about_section">
        <h2>Vision</h2>
        <p>
            Goldenstate College seeks to transform lives, organizations and communities through instruction, research
            and community service thereby paving the way for a holistic development of productive, successful, and 
            globally competitive professionals and graduates and responsible members of the community.
        </p>

        <p>
            The VISION of GOLDENSTATE COLLEGE which is the central inspiration of the organization is: 
            An economically, socially, and morally developed human resource who can respond to the needs of the 
            society locally, nationally, and globally. It is committed to giving the youth access to quality education 
            whereby students are prepared to make better decisions in life, provided with fitting opportunities to advance, 
            develop and benefit themselves and the society.
        </p>
    </div>

    <div class="school_bg"></div>

    <div class="about_section">
        <h2>Mission</h2>
        <p>
            GOLDENSTATE COLLEGE is a Filipino, non-sectarian, educational institution established to serve the educational 
            development needs of the society, locally, nationally, and globally.
        </p>
        <p>
            We are committed to providing holistic education to our students to ensure their development as a responsible 
            and globally competitive professional in their chosen fields of specialization enabling them to become responsible 
            community leaders sensitive to global and national development issues and challenges. To do this, we make proactive 
            decisions to support the career and personal development of our learners and ensure that our curriculum implementation, 
            teaching and learning processes and school services demonstrate that we are passionate about our mission critical fundamentals:
            <ul>
                <li>
                    As a college, we seek to understand and communicate the Truth by inculcating it among our students and stakeholders
                    in all their personal, school-related activities, social activism and professional pursuits.
                </li>
                <li>
                    As a Filipino International HEI, amidst the rising challenges and opportunities of globalization and ASEAN 
                    integration, we seek to preserve and promote the Filipino culture by embedding in our curricular offerings, 
                    research and co-curricular activities a sense of passionate understanding of Filipino identity equipped with 
                    needed competencies required to work in a borderless world.
                </li>
                <li>
                    As a Centre for Learning, we are committed to excellence in instruction, scholarly research and responsive 
                    community service.
                </li>
            </ul>
        </p>
    </div>

    <div class="school_bg"></div>

    <div class="about_section">
        <h2>
            Core Values
        </h2>
        <p>
            Teamwork. Providing support to one another, working co-operatively, respecting one another's views, and
            making our work environment fun and enjoyable.
        </p>
        <p>
        Excellence. Always doing what we say we will and striving for excellence and quality in everything we do.
        </p>
        <p>
           Professionalism. At all times we act with integrity, providing quality service, being reliable and responsible.
        </p>
        <p>
            Honesty. Being open and honest in all our dealings and maintaining the highest integrity at all times.
        </p>    
    </div>

</div>
<?php
     include("backtotop.php");
?>


<style>
    body {
        background: #DEDDD9;
    }
    .about_container{
        width: 96%;
        margin: 0 auto;
        margin-top: 80px;
        padding: 20px 0;
    }
    .about_section{
        margin-bottom: 20px;
        text-align: justify;
        text-justify: inter-word;
        padding: 20px;
        background: #fff;
    }
    .about_section h3, .about_section li {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 30px;
        list-style-type: none;
    }
    .about_section h2 {
        font-size: 20px;
        margin-bottom: 12px;
    }
   .about_section p {
       font-size: 14px;
       color: #333;
       margin-bottom: 12px;
   }

   .about_section:nth-child(1) {
       background: #fff;
       padding: 20px;
       margin-bottom: 0;
       display: flex;
   }
   .img_section {
        width: 100%;
        min-height: 30vh;
        background: #fff;
        background: url("./image/img_top.jpg");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
   }
    .credentials {
       width: 50%;
       background: url("./image/gsckannex.jpg");
       margin-left: 40px;
       background-position: center;
       background-size: cover;
       background-repeat: no-repeat;
   }
   .left_first_section {
       width: 50%;
   }
   .about_section:nth-child(3),
   .about_section:nth-child(4) {
       margin-bottom: 0;
   }
   .school_bg {
       width: 100%;
       min-height: 30vh;
       background: url("./image/gsckannex.jpg");
       background-size: cover;
       background-repeat: no-repeat;
       background-position: center;
       background-attachment: fixed;
   }
   @media screen and (max-width: 652px) {
       .about_section:nth-child(1) {
           display: block;
       }
       .left_first_section {
            width: 100%;
       }
       .credentials {
           display: none;
       }
   }



</style>