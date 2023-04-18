let id = window.location.search;
id = parseInt(id.substring(4))


var firebaseConfig = {
    apiKey: "AIzaSyDOne-swdHmSrAvJOxeCMGrpeDNJQ1Di4A",
    authDomain: "mutamimon-c1e68.firebaseapp.com",
    databaseURL: "https://mutamimon-c1e68-default-rtdb.firebaseio.com",
    projectId: "mutamimon-c1e68",
    storageBucket: "mutamimon-c1e68.appspot.com",
    messagingSenderId: "7245330178",
    appId: "1:7245330178:web:3a792f8f0b3215f915b41b",
    measurementId: "G-JVCXL6GDES"
};

firebase.initializeApp(firebaseConfig);
var messagesRef = firebase.database()
    .ref('Projects');
console.log(messagesRef);
let arr = [];

messagesRef.once("value", (snapshot) => {
    snapshot.forEach((element) => {

        let valId = parseInt(element.val().id)
        valId === id ? arr.push(element.val()) : console.log("welcome");

        console.log(valId)
        console.log(id);
    })
    arr.map(e => {

        document.querySelector(".property-box").innerHTML += `

<div class="project-top">
<div class="project_title">
    <div class="container clearfix">
        <div class="breadcrumbs-wrapper">
            <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                <p><a href="">الرئيسية</a><span class="separator"> - </span><a
                        href="/projects/">المشروعات</a><span class="separator"> - </span>
                        <span class="separator"> - </span><span class="last">${e.name}</span></p>
            </nav>
        </div>

        <h1>${e.name}</h1>

        <div class="project-misc">
            <span>بأسعار تبدأ من: ${e.price}</span>



        </div>

    </div>
</div>



     <div class="container" >
     <div id="slick" class=" project-gallery gallery-item">
     </div>
  




</div>
<div id="main-wrapper" class="layout-main-wrapper layout-container clearfix">
<div id="main" class="content_area layout-main clearfix">
<main id="content" class="column main-content">

    <div id="content-wrapper">
        <div class="row">
            <div class="col-12 col-sm-9 col-lg-9 left-side-bar">



                <div class="project-warpper">

                    <section class="about-project">
                        <h2 class="psection-title">
                            تفاصيل المشروع
                        </h2>
                        <div  id="">
                       <div class="projectDetails" >
                       <div class="project-details" ></div>
                       </div>        
                    </div>
                    </section>
                  

                   



                    <section class="about-project "  >
                        <h2 class="psection-title ">
                            عن المشروع
                        </h2>
                      
                        <p style="text-align: center;"><strong>${e.desc}</strong></p>
                 
                    </section>

                    <section class="project-map">
                        <h2 class="psection-title">
                            موقع المشروع
                        </h2>
                        <iframe
                        src="https://www.google.com/maps?q=${e.latitude},${e.longitude}&hl=es&z14&amp;output=embed&l&hl=ar"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                      
                    </section>



                    <div class="post-share">
                        <span class="share-title">أعجبك المشروع؟</span>
                        <div class="social-share-btns">
                            <a id="twitter" class="share-btn share-btn-twitter"
                            role="button"
                                  rel="nofollow" target="_blank"> <i class="fab fa-twitter"></i> غرد </a>
                            <a role="button" id="fb" class="share-btn share-btn-facebook"
    
                                rel="nofollow" target="_blank"> <i class="fab fa-facebook-f"></i> شارك </a>
                            <a class="share-btn share-btn-pinterest"
                                href="http://pinterest.com/pin/create/button/?url=https://www.mutamimon.com/projects/m-projects.html?id=${e.id}"
                                rel="nofollow" target="_blank"> <i class="fab fa-pinterest-p"></i> شارك </a>
                            <a class="share-btn share-btn-whatsapp"
                                href="whatsapp://send?text=https://www.mutamimon.com/projects/m-projects.html?id=${e.id}"
                                data-action="share/whatsapp/share" rel="nofollow" "> <i
                                    class="fab fa-whatsapp"></i> شارك </a>
                        </div>
                    </div>


                </div>



            </div><!-- end right section -->

            <div class="col-12 col-sm-3 col-lg-3 right-side-bar">
                <div id="side-bar" class="clearfix">
                    <div class="project-download">
                        <a href="${e.pdf}">تحميل بروشور المشروع</a>
                    </div>

                    <div class="message-section">
                    <span>للحجز أو الاستفسار</span>
                    <div class="wpforms-container wpforms-container-full project-form" id="wpforms-134">
                        <form id="wpforms-form-134"
                            class="wpforms-validate wpforms-form wpforms-ajax-form" data-formid="134"
                            action="https://getform.io/f/bb05e956-b6c2-4e1f-8461-80bf8779cd1b"
                            method="POST"><noscript
                                class="wpforms-error-noscript">Please enable JavaScript in your browser
                                to complete this form.</noscript>
                            <div class="wpforms-field-container">
                                <div id="wpforms-134-field_3-container"
                                    class="wpforms-field wpforms-field-text" data-field-id="3"><label
                                        class="wpforms-field-label wpforms-label-hide"
                                        for="wpforms-134-field_3">الاسم <span
                                            class="wpforms-required-label">*</span></label><input
                                        type="text" id="name"
                                        class="wpforms-field-large wpforms-field-required"
                                        name="name" placeholder="الاسم" required></div>
                                <div id="wpforms-134-field_4-container"
                                    class="wpforms-field wpforms-field-text" data-field-id="4"><label
                                        class="wpforms-field-label wpforms-label-hide"
                                        for="wpforms-134-field_4">رقم الهاتف <span
                                            class="wpforms-required-label">*</span></label><input
                                        type="text" id="phone"
                                        class="wpforms-field-large wpforms-field-required"
                                        name="phone" placeholder="رقم الهاتف" required>
                                </div>
                                <div id="wpforms-134-field_1-container"
                                    class="wpforms-field wpforms-field-textarea" data-field-id="1">
                                    <label class="wpforms-field-label wpforms-label-hide"
                                        for="wpforms-134-field_1">رسالتك</label><textarea
                                        id="message" class="wpforms-field-small"
                                        name="message"
                                        placeholder="ما هو استفسارك؟"></textarea>
                                </div>
                            </div>
                            <div class="wpforms-submit-container"><input type="hidden"
                                    name="wpforms[id]" value="134"><input type="hidden"
                                    name="wpforms[author]" value="1"><input type="hidden"
                                    name="wpforms[post_id]" value="83"><button type="submit"
                                    name="wpforms[submit]" id="wpforms-submit-134"
                                    class="wpforms-submit project-form-submit"
                                    data-alt-text="جاري الإرسال..." data-submit-text="إرسال"
                                    aria-live="assertive" value="wpforms-submit">إرسال</button><img
                                    src="/wp-content/plugins/wpforms-lite/assets/images/submit-spin.svg"
                                    class="wpforms-submit-spinner" style="display: none;" width="26"
                                    height="26" alt=""></div>
                        </form>
                    </div> <!-- .wpforms-container -->
                </div>

                    <div class="contact-section">
                        <a href="tel:920000486" class="phone"><i class="fas fa-phone"></i> تواصل عبر
                            الهاتف</a>

                        <a href="https://api.whatsapp.com/send?phone=920000486+&amp;text=أريد الاستفسار عن ${e.name}"
                            target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i> تواصل عبر
                            واتساب</a>

                    </div>

                    <div class="banner-section">
                    <a class=""> ${e.adv.length > 0 ? ` <a target="-blank" href="${e.advLink}">
                    <img src="${e.adv}"> </a>` : ""}
                    </div>


                </div>
            </div>





        </div>
        <div class="related-section">
		<div class="container">
			<h3 class="related-title">
				مشاريع أخري
			</h3>

            <div  class="property-card home-project" ></div>


</main>
</div>
</div>


`

        function shareOnFacebook() {
            const navUrl = `https://www.facebook.com/sharer/sharer.php?u=https://www.mutamimon.com/projects/projects/m-projects.html?id=${e.id}`;
            window.open(navUrl, '_blank');
        }

        const fb = document.getElementById('fb');
        fb.addEventListener('click', shareOnFacebook);


        function shareOnTwitter() {
            const navUrl =
                `https://twitter.com/intent/tweet?text=https://www.mutamimon.com/projects/m-projects.html?id=${e.id} ` + `https://www.mutamimon.com/projects/m-projects.html?id=${e.id}`


                ;
            window.open(navUrl, '_blank');
        }

        const tweet = document.getElementById('twitter');
        tweet.addEventListener('click', shareOnTwitter);

        messagesRef.once("value", (snapshot) => {
            snapshot.forEach((element) => {
                console.log(element.val());
                element.val().current === "مشاريع حاليه" ? arr.push(element.val()) : console.log("welcome");
                console.log(arr);
            })
            arr.slice(0,7).map(e => {
                document.querySelector(".property-card").innerHTML += `
        
    <div class="col-md-4">
                <div class="recent-property">
                    
                    <h3><a role="button" onclick="getPage('${e.id}')">${e.name}</a></h3>
                    <div class="pimg-wrapper">
                        <a ole="button" onclick="getPage('${e.id}')">
                            <img src="${e.thePhoto}" width="480"
                                height="299" alt="متممون فالي 1" title="متممون فالي 1">
                        </a>
                        <a class="project-type" role="button" onclick="getCurr('${e.category}')">${e.category}</a>
                    </div>

                    <div class="project-excerpt">
                        <p>${e.desc}</p>
                    </div>

                
                </div>
    
                <a class="">${e.status == "جديدة" ? `<a class="project-status">${e.status}</a>` : ""}</a>
                <a class="">${e.status == "مباع" ? `<a class="project-soldout">${e.status}</a>` : ""}</a>
                <a class="">${e.status == "تحت الانشاء" ? `<a class="project-underConstruction ">${e.status}</a>` : ""}</a>
            </div>
`



                $(document).ready(function () {
                    $('.home-project').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        responsive: [{
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        ]
                    });
                });
            })


        })




        let z = document.querySelector(".project-gallery");

        if (!e.photo) {
            console.log("Sorry , but this project have no images !");
        } else {
            for (let i = 0; i < e.photo.length; i++) {

                let input = document.createElement("img");
                input.classList.add("w-100")
                input.src = e.photo[i].url;

                z.appendChild(input);

            }
        }

        // let x = document.querySelector(".project-details");

        // if (!e.imagesDetails) {
        //     console.log("Sorry , but this project have no images !");
        // } else {
        //     for (let i = 0; i < e.imagesDetails.length; i++) {

        //         let inputDetails = document.createElement("img");
        //         inputDetails.style = "margin:10px ; border-radius:5px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"
        //         inputDetails.src = e.imagesDetails[i].url;
        //         x.appendChild(inputDetails);

        //     }
        // }







        // let p = document.getElementById("zeTable");
        // if (!e.details) {
        //     console.log("Sorry , but this project have no deatails !");
        // } else {
        //     for (let i = 0; i < e.details.length; i++) {
        //         if (i == 2) {
        //             let r = document.createElement("td");
        //             r.innerText = e.details[i].text;
        //             p.appendChild(r);
        //         }
        //         else {
        //             let t = document.createElement("tr");
        //             let r = document.createElement("td");
        //             r.innerText = e.details[i].text;
        //             t.appendChild(r);
        //             p.appendChild(t);
        //         }
        //         console.clear();

        //     }
        // }



        $('.project-gallery').each(function () {
            var slider = $(this);
            slider.slick({
                arrows: true,
                dots: true,
                accessibility: false,
                infinite: true,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 4000,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1 ,
                        dots: false,
                    }
                }
                ]
            });
            // $(document).ready(function(){
            //     $('.project-gallery').slickLightbox({
            //       itemSelector: 'img'
            //     });
            //   });

            var sLightbox = $(this);
            sLightbox.slickLightbox({
                src: 'src',
                itemSelector: 'img'
            });

        });

        // Get the container element where the cards will be displayed
        var container = document.querySelector(".project-details");

        // Loop through the apartments array and create a card for each apartment
        for (var i = 0; i < e.apartments.length; i++) {
            // Create a div element with the "card" class
            var card = document.createElement("div");
            card.classList.add("col-md-4");
            card.classList.add("apartment-card");

            // Create a header element with the apartment number
            var header = document.createElement("h2");
            header.textContent = "رقم الشقة : " + e.apartments[i].name;
            card.appendChild(header);

            // Create a paragraph element with the floor number and rent amount
            var dis = document.createElement("div")
            var info = document.createElement("p");
            info.textContent = " الدور : " + e.apartments[i].number
            info.style.fontWeight = "bolder"
            info.style.textAlign = "center"
            card.appendChild(info);


            var info = document.createElement("p");
            info.textContent = "المساحة : " + e.apartments[i].rent
            info.style.fontWeight = "bolder"
            info.style.textAlign = "center"
            card.appendChild(info);

            var info = document.createElement("p");
            info.textContent = "المواصفات : " + e.apartments[i].spefic
            info.style.fontWeight = "bolder"
            info.style.textAlign = "center"
            card.appendChild(info);

            var infoPrice = document.createElement("p");
            infoPrice.textContent = "السعر : " + e.apartments[i].price
            infoPrice.style.fontWeight = "bolder"
            infoPrice.style.fontSize = "2rem"
            infoPrice.style.textAlign = "center"
            card.appendChild(infoPrice);


            var availabilityLabel = document.createElement("label");
            availabilityLabel.className = "availability-label";
            if (e.apartments[i].notic === "متاح") {
                availabilityLabel.innerHTML = "متاح ";
                card.classList.add("available")
            } else if (e.apartments[i].notic === "مباع") {
                availabilityLabel.innerHTML = "مباع";
                card.classList.add("unavailable");
                infoPrice.textContent = "غير متاح"
                infoPrice.style.color = "red"
            }
            card.appendChild(availabilityLabel);

            // Create a button for reserving the apartment
            var reserveButton = document.createElement("button");
            reserveButton.className = "reserve-button";
            reserveButton.disabled = e.apartments[i].notic !== "متاح";
            reserveButton.innerHTML = "حجز";
            card.appendChild(reserveButton);
            container.appendChild(card);

            if (e.apartments[i].notic === "متاح") {
                reserveButton.target = "_blank";
                reserveButton.onclick = function () {
                    window.open('https://www.google.com', '_blank');
                }
            } else {
                reserveButton.disabled = true;
            }


        }



    })


})





function getPage(id) {
    window.location.href = "/projects/m-projects.html?id=" + id;

}
function getCurr(category) {
    window.location.href = "/type/" + category;

}





































