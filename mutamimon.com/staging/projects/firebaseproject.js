
let id = window.location.search;
id = id.substring(4);
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
        let valId = element.val().id;
        // console.log(id);
        // console.log(valId.toString());

        valId.toString() === id ? arr.push(element.val()) : console.log("welcome");
        // console.log(arr);
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




    <div id="slick" class=" project-gallery gallery-item">




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
                        <div  id="summary" class="">
                         <iframe style="border:none;  border-radius: 15px;" width="100%" height="500" src="${e.projectDetails}" ></iframe>             
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
                        src="https://www.google.com/maps?q=${e.latitude},${e.longitude}&hl=es&z14&amp;output=embed"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                      
                    </section>



                    <div class="post-share">
                        <span class="share-title">أعجبك المشروع؟</span>
                        <div class="social-share-btns">
                            <a class="share-btn share-btn-twitter"
                                href="https://twitter.com/intent/tweet?text=/projects/%d9%88%d8%ad%d8%af%d8%a7%d8%aa-%d9%85%d8%aa%d9%85%d9%85%d9%88%d9%86-%d8%ad%d9%8a-%d8%a7%d9%84%d9%85%d9%84%d9%83-%d9%81%d9%87%d8%af/"
                                rel="nofollow" target="_blank"> <i class="fab fa-twitter"></i> غرد </a>
                            <a class="share-btn share-btn-facebook"
                                href="https://www.facebook.com/sharer/sharer.php?u=/projects/%d9%88%d8%ad%d8%af%d8%a7%d8%aa-%d9%85%d8%aa%d9%85%d9%85%d9%88%d9%86-%d8%ad%d9%8a-%d8%a7%d9%84%d9%85%d9%84%d9%83-%d9%81%d9%87%d8%af/"
                                rel="nofollow" target="_blank"> <i class="fab fa-facebook-f"></i> شارك </a>
                            <a class="share-btn share-btn-pinterest"
                                href="http://pinterest.com/pin/create/button/?url=/projects/%d9%88%d8%ad%d8%af%d8%a7%d8%aa-%d9%85%d8%aa%d9%85%d9%85%d9%88%d9%86-%d8%ad%d9%8a-%d8%a7%d9%84%d9%85%d9%84%d9%83-%d9%81%d9%87%d8%af/"
                                rel="nofollow" target="_blank"> <i class="fab fa-pinterest-p"></i> شارك </a>
                            <a class="share-btn share-btn-whatsapp"
                                href="whatsapp://send?text=/projects/%d9%88%d8%ad%d8%af%d8%a7%d8%aa-%d9%85%d8%aa%d9%85%d9%85%d9%88%d9%86-%d8%ad%d9%8a-%d8%a7%d9%84%d9%85%d9%84%d9%83-%d9%81%d9%87%d8%af/"
                                data-action="share/whatsapp/share" rel="nofollow" target="_blank"> <i
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
                        <a href="tel:+966551936636" class="phone"><i class="fas fa-phone"></i> تواصل عبر
                            الهاتف</a>

                        <a href="https://api.whatsapp.com/send?phone=966501398017&amp;text=أريد الاستفسار عن وحدات متممون حي الملك فهد"
                            target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i> تواصل عبر
                            واتساب</a>

                    </div>

                    <div class="banner-section">
                    <a class=""> ${e.adv.length > 0 || "" ?  ` <a target="-blank" href="${e.advLink}">
                    <img src="${e.adv}"> </a>` : `       <div class="banner-section">
                    <img src="/wp-content/uploads/2022/06/banner.jpg">
                    </div>` }
                    </div>


                </div>
            </div>





        </div>
    </div>

</main>
</div>
</div>

`
        let z = document.querySelector(".project-gallery");

        if (!e.photo) {
            console.log("Sorry , but this project have no images !");
        } else {
            for (let i = 0; i < e.photo.length; i++) {

                let input = document.createElement("img");
                input.src = e.photo[i].url;
                z.appendChild(input);

            }
        }



        let p = document.getElementById("zeTable");
        if(!e.details){
            console.log("Sorry , but this project have no deatails !");
        }else{
            for (let i = 0; i < e.details.length; i++) {
                if (i == 2) {
                    let r = document.createElement("td");
                    r.innerText = e.details[i].text;
                    p.appendChild(r);
                }
                else {
                    let t = document.createElement("tr");
                    let r = document.createElement("td");
                    r.innerText = e.details[i].text;
                    t.appendChild(r);
                    p.appendChild(t);
                }
                console.clear();
    
            }
        }



        $('.project-gallery').each(function () {
            var slider = $(this);
            slider.slick({
                arrows: true,
                dots: true,
                accessibility: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
                slidesToShow: 4,
                slidesToScroll: 1,
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
  
    })
})










































