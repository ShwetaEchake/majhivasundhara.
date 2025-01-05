<x-frontend.layout>
    <x-slot name="title">माझी वसुंधरा | Home</x-slot>

    @push('styles')
        <style>
            .blinktext {
                -webkit-animation: blink-text 800ms linear infinite;
                animation: blink-text 3000ms linear infinite;
            }
            @-webkit-keyframes blink-text {
                0% { color: #155724; opacity: 1; }
                20% { color: #155724;opacity: .8; }
                30% { color: #155724;opacity: .6; }
                40% { color: #155724;opacity: .4; }
                50% { color: #155724;opacity: .2; }
                60% { color: #155724;opacity: 0; }
                70% { color: #155724;opacity: .2; }
                80% { color: #155724;opacity: .4; }
                90% { color: #155724;opacity: .6; }
                98% { color: #155724;opacity: .8; }
                100% { color: #155724;opacity: 1; }
            }
            @keyframes blink-text {
                0% { color: #155724; opacity: 1; }
                20% { color: #155724;opacity: .8; }
                30% { color: #155724;opacity: .6; }
                40% { color: #155724;opacity: .4; }
                50% { color: #155724;opacity: .2; }
                60% { color: #155724;opacity: 0; }
                70% { color: #155724;opacity: .2; }
                80% { color: #155724;opacity: .4; }
                90% { color: #155724;opacity: .6; }
                98% { color: #155724;opacity: .8; }
                100% { color: #155724;opacity: 1; }
            }
        </style>
    @endpush

    <!--START HOME-->
    <section class="section bg-home home-half" id="home" data-image-src="{{ asset('frontend/images/bg-home.jpg') }}">
        <div class="bg-overlay"></div>
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            <h1 class="home-title"></h1>
                            <p class="pt-3"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wave-effect wave-anim">
            <div class="waves-shape shape-one">
                <div class="wave wave-one">
                    <svg width="2000" height="100" viewBox="0 0 2000 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M471 45C263 -22.2 71 18.6667 1 47.5V119H1999.5V34.5C1917.9 85.3 1823.83 68.3333 1787 53.5C1721.8 25.1 1603.17 9.33333 1552 4.99999C1366.4 -12.6 1172.67 34.3333 1099 60C1014.6 91.6 831.833 97.5 751 96.5C664.6 96.5 528.333 62.1667 471 45Z" fill="white" stroke="white" />
                    </svg>
                </div>
            </div>
            <div class="waves-shape shape-two">
                <div class="wave wave-two">
                </div>
            </div>
            <div class="waves-shape shape-three">
                <div class="wave wave-three">

                </div>
            </div>
        </div>
    </section>
    <!--END HOME-->

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 alert alert-success blinktext">
                    <h4 style="line-height: 1.8rem">
                        पर्यावरण संवर्धन कृती स्पर्धा व जनजागृती स्पर्धेमध्ये स्पर्धकांना नोंदणी करण्यासाठी व माहिती सादर करण्यासाठी दिनांक 29 फेब्रुवारी, 2024 रोजीपर्यंत मुदतवाढ देण्यात येत आहे. तसेच स्पर्धेमध्ये सादर करावयाच्या माहितीचा कालावधीदेखिल दिनांक 29 फेब्रुवारी, 2024 पर्यंत वाढविण्यात आलेला असून, दिनांक 1 एप्रिल 2023 ते 29 फेब्रुवारी, 2024 या कालावधीतील माहिती स्पर्धेकरिता स्विकारण्यात येईल.
                    </h4>
                </div>
                
                <div class="col-12 alert alert-success blinktext">
                    <h4 style="line-height: 1.8rem">
                        आपल्या माहितीपट/ पथनाट्याचा #pollutioncontrolcellthane या फेसबुक पृष्ठावरील अधिकतम लाईक्स असलेला फोटो (Screenshot)  tmcenvirocompetition@gmail.com या ई-मेलवर दिनांक 31 मार्च, 2024 रोजी दुपारी 12:00 वा. पूर्वी सादर करावा. त्यानंतर सादर करण्यात आलेल्या ई-मेलचा विचार करण्यात येणार नाही.
                    </h4>
                </div>
                
                <h4 class="text-muted web-desc mt-4"> <a href="{{ asset('frontend/timesheet.pdf') }}" target="_blank">जनजागृती स्पर्धेचे सुधारित वेळापत्रक</a> </h4>
                
            </div>
        </div>
    </section>

    <!--END ABOUT US-->
    <section class="section" id="features">
        <div class="container">
            <div class="row vertical-content">
                <div class="col-lg-7">
                    <div class="features-box">
                        <h3>माझी वसुंधरा अभियान अंतर्गत स्पर्धा</h3>
                        <p class="text-muted web-desc">राज्य शासनाद्वारे आयोजित माझी वसुंधरा अभियान 1.0 मध्ये ठाणे महानगरपालिकेस अमृत शहराच्या गटात प्रथम पारितोषीक प्राप्त झालेले आहे. तसेच, सदर पारितोषीक रकमेच्या विनियोगाची कार्यपद्धती शासनाद्वारे निश्चित करण्यात आलेली असून त्यापैकी काही रक्कम महापालिका क्षेत्रातील नागरिकांचा अभियानामध्ये सहभाग वाढविणे व सदर रक्कम बक्षिस स्वरुपात वितरीत करण्यास निर्देशित आहे. त्यानुसार सदर स्पर्धेचे आयोजन ठाणे महानगरपालिकेद्वारे महापालिका क्षेत्रात करण्यात येत आहे.</p>
                        <p class="text-muted web-desc">माझी वसुंधरा अभियानाचा मूळ पाया हा निसर्गातील पृथ्वी, वायु, जल, अग्नी व आकाश या पंचतत्वावर आधारीत आहे. त्याच धर्तीवर ठाणे महानगरपालिका क्षेत्रातील विविध घटकांमध्ये उदा. गृहसंकुले, शैक्षणिक संस्था, वाणिज्य आस्थापना, औद्योगिक संस्था, इतर शासकीय कार्यालये/महाविद्यालये, इ. घटकांमध्ये निसर्गातील पंचतत्वावर आधारीत बाबींचा विचार करुन स्पर्धा आयोजित करण्यात येत आहे.</p>
                        <p class="text-muted web-desc">सदर स्पर्धेच्या आयोजनामुळे गृहसंकुले, शालेय संस्था, वाणिज्य आस्थापना, औद्योगिक संस्था, इतर शासकीय कार्यालये/ महाविद्यालये, इ. पातळ्यांवर राबविण्यात येणा-या पर्यावरण संवर्धनीय उपक्रमांना प्रोत्साहन देऊन सदर संस्था/नागरिकांना ठाणे शहराच्या पर्यावरण संवर्धनात सहभागी करुन घेता येईल.</p>
                        <p class="text-muted web-desc">या स्पर्धेमुळे ठाणे महापालिका क्षेत्रातील उत्कृष्ट प्रकल्प ठाणे महानगरपालिकेस शासनाच्या मूळ माझी वसुंधरा अभियानामध्ये सहभागी करुन घेता येतील.</p>
                        <p class="text-muted web-desc"> <a href="{{ asset('frontend/sparda.pdf') }}" target="_blank">स्पर्धेचे स्वरूप माहितीसाठी pdf डाउनलोड करा</a> </p>
                        <p class="text-muted web-desc"> <a href="{{ asset('frontend/guidelines.pdf') }}" target="_blank">जागरूकता स्पर्धा मार्गदर्शक तत्त्वे PDF</a> </p>
                        <p class="text-muted web-desc"> <a href="{{ asset('frontend/prabhag_samiti.pdf') }}" target="_blank">प्रभाग समिती क्षेत्र संबंध अधिकारी व कर्मचारी संपर्क क्रमांक यादी</a> </p>

                        {{-- <a href="" class="btn btn-primary mt-4 ">Download App<i class="mdi mdi-arrow-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="features-img features-right text-end">
                        <img src="{{ asset('frontend/images/online-world.svg') }}" alt="macbook image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END ABOUT US-->




    <!--END ABOUT US-->
    <section class="section bg-light" id="features">
        <div class="container">
            <div class="row vertical-content">
                <div class="col-lg-5">
                    <div class="features-img features-right text-end">
                        <img src="{{ asset('frontend/images/2.png') }}" alt="macbook image" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="features-box">
                        <h3>सहभागी गट</h3>
                        <p class="text-muted web-desc">माझी वसुंधरा अभियानाकरिता राज्य शासनाद्वारे निश्चित करण्यात आलेल्या निकषांवर आधारीतच घटकांवर सदर स्पर्धेचे आयोजन करण्यात आलेले खालीलप्रमाणे नमूद गटामध्ये स्पर्धा आयोजन होणार आहे.</p>
                        <p class="text-muted web-desc">सदर स्पर्धेमध्ये फक्त ठाणे महानगरपालिका हद्दीतीलच गृहसंकुले, शैक्षणिक संस्था, वाणिज्य आस्थापना, सरकारी आणि व्यापारी संस्था, हॉस्पिटल, हॉटेल्स, वरिष्ठ महाविद्यालये, सरकारी कार्यालये, खाजगी कार्यालये सहभागी होऊ शकतील. सदर स्पर्धा राबविताना संपूर्ण ठामपा क्षेत्रातील अधिकतम संस्था /आस्थापनाना सहभागी होता यावे व भौतिक परिस्थितीनुसार सर्व प्रभाग समिती क्षेत्रांतून स्पर्धक सहभागी व्हावे याकरिता यशस्वी स्पर्धक निवड ही ठामपा प्रभाग समिती स्तरावर करण्यात येईल.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END ABOUT US-->



    <!--END ABOUT US-->
    <section class="section" id="features">
        <div class="container">
            <div class="row vertical-content">
                <div class="col-lg-7">
                    <div class="features-box">
                        <h3>गुण वितरणाची पद्धत : (Self-Assessment Method)</h3>
                        <p class="text-muted web-desc">
                        सदर स्पर्धेत सहभागी होणा-या संस्था/ आस्थापनांना दिनांक १ एप्रिल २०२३ ते ३१ जानेवारी २०२४ या कालावधीतील केलेल्या कामास अनुसरुन गुणांकन करावयाचे आहे. गुणांकन हे स्वयंमुल्य निर्धारण पद्धतीने (Self Assessment Method) करावयाचे असून संस्थेने स्पर्धा कालावधीत केलेल्या कामास अनुसरुन स्वतःलाच गुण वितरीत करायचे आहेत. वितरीत गुणांनुसार अधिकतम गुण प्राप्त संस्था / आस्थापनेची स्थळ पाहणी महापालिकेच्या मुल्यमापन समितीद्वारे करुन गुणांची पडताळणी करण्यात येईल व त्यानुसार एकूण गुण निश्चित करण्यात येतील.  प्रत्येक उपक्रमाचे Geo टॅग फोटो सादर करणे बंधनकारक राहील, अन्यथा गुणांक ग्राह धरण्यात येणार नाही
                        </p>
                        <p class="text-muted web-desc">
                        अंतिम गुण निश्चित करण्याचा सर्वस्वी अधिकार मा. आयुक्त सो. यांचेद्वारे नियुक्त मुल्यमापन समितीचा असेल व त्या गुणांकनास आव्हान करता येणार नाही.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="features-img features-right text-end">
                        <img src="{{ asset('frontend/images/4.png') }}" alt="macbook image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END ABOUT US-->


</x-frontend.layout>
