@extends('layouts.master')

@section('title', '關於我')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/aboutme/roger.png') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">Roger Wu (吳偉召)</h3>
                            <p class="text-muted text-center">Website Engineer</p>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>
                            <p class="text-muted">淡江大學<br><span class="text-muted text-sm">電機工程學系/大學畢業</span></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">新北市，新店區</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <ul>
                                <li>PHP程式設計</li>
                                <li>產品開發</li>
                                <li>網路管理</li>
                                <li>網頁設計</li>
                            </ul>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">
                                自從在大學時期開始接觸電腦時，我非常熱愛接觸任何與電腦相關的訊息，並學習任何與電腦相關的知識，
                                包括：硬體設備、作業系統、程式語言、網路及各種應用軟體，加上自身電子電機科系，對於電子電路並不陌生，
                                因此奠下往後在資訊產業的工作基礎。
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-danger card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">專業及經歷</a></li>
                                <li class="nav-item"><a class="nav-link" href="#achievement" data-toggle="tab">網站專案</a></li>
                                <li class="nav-item"><a class="nav-link" href="#products" data-toggle="tab">產品開發</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <h5 class="col-10 offset-1">過去我的專業主要是在電子產品企劃開發（繪圖板、數位筆記本、數位筆及電容筆相關技術），現在我的專業專注在PHP程式設計。</h5>
                                    <div class="row">
                                        <div class="card card-primary card-outline col-4">
                                            <div class="card-header">
                                                <h5><b>前端程式技術</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>語言技能：HTML、CSS</li>
                                                    <li>CSS框架：BootStrap</li>
                                                    <li>程式語言：JavaScript、JQuery</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card card-danger card-outline col-4">
                                            <div class="card-header">
                                                <h5><b>後端程式技術</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>語言技能：PHP</li>
                                                    <li>程式框架：CodeIgniter、Laravel</li>
                                                    <li>資料庫：MySQL</li>
                                                    <li>伺服器：Apache</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card card-info card-outline col-4">
                                            <div class="card-header">
                                                <h5><b>其他技能</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>資訊安全弱點掃描處理</li>
                                                    <li>Git 操作及伺服器建置</li>
                                                    <li>CentOS 伺服器建置與管理</li>
                                                    <li>網路規劃與管理</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-info">Apr. 2019 ~ Nov. 2020</span>
                                            <span class="bg-info">康百企業網路多媒體部</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-network-wired bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Apr. 2019 ~ Nov. 2020</span>
                                                <div class="timeline-header">
                                                    <span><b>網站設計工程師</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>公司內部伺服器建置與維護.</li>
                                                        <ul>
                                                            <li>LAMP 測試伺服器</li>
                                                            <li>Git Server</li>
                                                        </ul>
                                                        <li>公司現有客戶PHP網站專案維護</li>
                                                        <ul>
                                                            <li>教育部性別平等全球資訊網</li>
                                                            <li>田園銀行網路平台</li>
                                                            <li>公園走透透．台北新花樣及相關主題網</li>
                                                        </ul>
                                                        <li>新專案評比企劃及相關技術文件撰寫</li>
                                                        <li>新專案網站前後台架構、資料庫規劃、程式設計、系統建置、維護管理及相關技術文件撰寫</li>
                                                        <ul>
                                                            <li>國際人權亞太分會英文網站</li>
                                                            <li>司法院查詢機系統</li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-label">
                                            <span class="bg-yellow">Sep. 2018 ~ Mar. 2019</span>
                                            <span class="bg-yellow">勞動署北分署 - 泰山 107 PHP資料庫網頁設計班 (02期) 學員</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-user-graduate bg-yellow"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Sep. 2018 ~ Mar. 2019</span>
                                                <div class="timeline-header">
                                                    <span><b>學員</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>網頁排版編輯 - HTML標籤、CSS樣式、Dreamweaver網頁設計.</li>
                                                        <li>視覺影像設計 - Photoshop數位影像處理、Illustrator向量繪圖設計</li>
                                                        <li>數位媒體應用 - 視覺傳達編排設計、UI/UX設計流程</li>
                                                        <li>網頁動態技術 - jQuery視覺效果、JQM開發應用、Bootstrap工具應用、CMS架站系統</li>
                                                        <li>資料庫程式設計 - PHP資料庫應用、XAMPP伺服器架設、JavaScript動態功能</li>
                                                        <li>網頁設計實務 - 網頁設計乙級檢定術科輔導</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-label">
                                            <span class="bg-blue">Jul. 2002 ~ Aug. 2018</span>
                                            <span class="bg-blue">億燿企業股份有限公司</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-edit bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Jan. 2013 ~ Aug. 2018</span>
                                                <div class="timeline-header">
                                                    <span><b>產品部經理</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>專利分析、撰寫、商標資料管理.</li>
                                                        <li>HP電容筆ODM開發案. (22萬支訂單)</li>
                                                        <li>新產品開發、設計、規劃、測試. (PenPaper)</li>
                                                        <li>產品包裝設計及說明書撰寫、排版. (PenPaper)</li>
                                                        <li>網路規劃及管理. (新辦公室)</li>
                                                        <li>網站架設及管理. (改用NAS)</li>
                                                        <li>產品行銷、網頁設計及產品影片製作.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-edit bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Jul. 2006 ~ Jan. 2013</span>
                                                <div class="timeline-header">
                                                    <span><b>產品部副理</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>專利分析、撰寫、商標資料管理.</li>
                                                        <li>新產品開發、設計、規劃、測試. (DigiMemo、Speed Dial)</li>
                                                        <li>產品包裝設計及說明書撰寫、排版.</li>
                                                        <li>技術服務支援. (國外信件)</li>
                                                        <li>展場支援. (DigiMemo產品)</li>
                                                        <li>網站架設及網頁設計. (改用Joomla CMS)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-edit bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Jul. 2004 ~ Jul. 2006</span>
                                                <div class="timeline-header">
                                                    <span><b>產品工程師</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>專利分析、撰寫、商標資料管理.</li>
                                                        <li>專利舉發案處理. (舉發並撤銷競爭對手專利)</li>
                                                        <li>兼任機構工程師.</li>
                                                        <li>產品包裝設計、說明書排版. (DigiMemo)</li>
                                                        <li>展場支援. (DigiMemo產品)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-network-wired bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Jul. 2002 ~ 2004</span>
                                                <div class="timeline-header">
                                                    <span><b>助理工程師</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li>協助員工電腦操作疑難雜症.</li>
                                                        <li>員工電腦設備維護及管理.</li>
                                                        <li>Windows Server建置、維護及管理.</li>
                                                        <li>網路規劃、布線及管理.</li>
                                                        <li>Firewall, Gateway, DNS, Web, Mail base on FreeBSD Server建置及管理.</li>
                                                        <li>網站架設及網頁設計.</li>
                                                        <li>展場支援. (數位板產品)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-label">
                                            <span class="bg-success">Sep. 2000 ~ Jun. 2002</span>
                                            <span class="bg-success">網路家庭集團</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-network-wired bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Jun. 2001 ~ Jun.
                                                    2002</span>
                                                <div class="timeline-header">
                                                    <span><b>網路家庭國際資訊股份有限公司</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <h5 class="timeline-header">網管工程師</h5>
                                                    <ul>
                                                        <li>機房管理及設備維護.</li>
                                                        <li>網路規劃及管理.</li>
                                                        <li>Firewall, Gateway, DNS, Web, Mail base on FreeBSD Server
                                                            建置及管理.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-desktop bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> Sep. 2000 ~ Jun. 2001</span>
                                                <div class="timeline-header">
                                                    <span><b>網路原力資訊股份有限公司</b></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <h5>MIS工程師</h5>
                                                    <ul>
                                                        <li>協助集團員工電腦操作疑難雜症.</li>
                                                        <li>集團員工電腦及資訊設備維護及管理.</li>
                                                        <li>Windows Server建置、維護及管理.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="achievement">
                                    <div class="row">
                                        <div class="post col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title"><i class="fas fa-synagogue mr-2"></i><a href="https://fihrmap.nhrm.gov.tw/"
                                                            target="_blank" title="FIHRM-ASIA PACIFIC" class="text-yellow">FIHRM-ASIA PACIFIC</a></h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/fihrmap.jpg') }}" data-toggle="lightbox" data-title="FIHRM-ASIA PACIFIC"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/fihrmap.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title"><i class="fas fa-synagogue mr-2"></i><a href="https://www.gender.edu.tw/"
                                                            target="_blank" title="性別平等教育全球資訊網" class="text-yellow">性別平等教育全球資訊網</a></h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/gender.jpg') }}" data-toggle="lightbox" data-title="性別平等教育全球資訊網"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/gender.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title"><i class="fas fa-synagogue mr-2"></i><a href="https://farmcity.taipei/"
                                                            target="_blank" title="田園銀行網路平台" class="text-yellow">田園銀行網路平台</a></h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/farmcity.jpg') }}" data-toggle="lightbox" data-title="田園銀行網路平台"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/farmcity.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title"><i class="fas fa-synagogue mr-2"></i><a href="https://parks.taipei/" target="_blank"
                                                            title="公園走透透‧台北新花漾" class="text-yellow">公園走透透‧台北新花漾</a></h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/parks.jpg') }}" data-toggle="lightbox" data-title="公園走透透‧台北新花漾"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/parks.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-danger">
                                                    <h3 class="card-title"><i class="fas fa-synagogue mr-2"></i><a href="https://kiosk.rvt.idv.tw/"
                                                            target="_blank" title="司法院查詢機專案" class="text-yellow">司法院查詢機專案</a></h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/kiosk2.jpg') }}" data-toggle="lightbox" data-title="司法院查詢機專案"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/kiosk2.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="products">
                                    <div class="row">
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title">DigiMemo – Digital Note with Memory and Tablet Combo</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/l2.jpg') }}" data-toggle="lightbox"
                                                        data-title="DigiMemo – Digital Note with Memory and Tablet Combo" data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/l2.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/l2.pdf') }}" class="btn btn-sm btn-primary"
                                                        title="DigiMemo – Digital Note with Memory and Tablet Combo" target="_blank">產品型錄</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title">PenPaper – Bluetooth Digital Notepad and Pen Tablet for Win</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/penpaper.jpg') }}" data-toggle="lightbox"
                                                        data-title="PenPaper – Bluetooth Digital Notepad and Pen Tablet for Win" data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/penpaper.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/penpaper.pdf') }}" class="btn btn-sm btn-primary"
                                                        title="PenPaper – Bluetooth Digital Notepad and Pen Tablet for Win" target="_blank">產品型錄</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-purple">
                                                    <h3 class="card-title">DigiMemo – Digital Note with Memory</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/a5.jpg') }}" data-toggle="lightbox"
                                                        data-title="DigiMemo – Digital Note with Memory" data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/a5.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/a5.pdf') }}" class="btn btn-sm btn-primary"
                                                        title="DigiMemo – Digital Note with Memory" target="_blank">產品型錄</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-purple">
                                                    <h3 class="card-title">AceDialer – Bluetooth Speed Dial Controller</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/acedialer.jpg') }}" data-toggle="lightbox"
                                                        data-title="AceDialer – Bluetooth Speed Dial Controller" data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/acedialer.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/acedialer.pdf') }}" class="btn btn-sm btn-primary"
                                                        title="AceDialer – Bluetooth Speed Dial Controller" target="_blank">產品型錄</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-warning">
                                                    <h3 class="card-title">專利發明1</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/p1.jpg') }}" data-toggle="lightbox" data-title="專利發明1"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/p1.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/p1-t.pdf') }}" class="btn btn-sm btn-primary mr-3" title="專利發明1"
                                                        target="_blank">台灣證書</a>
                                                    <a href="{{ asset('img/aboutme/product/p1-u.pdf') }}" class="btn btn-sm btn-primary" title="專利發明1"
                                                        target="_blank">美國證書</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 post">
                                            <div class="card">
                                                <div class="card-header bg-warning">
                                                    <h3 class="card-title">專利發明2</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/p2.jpg') }}" data-toggle="lightbox" data-title="專利發明2"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/p2.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/p2-t.pdf') }}" class="btn btn-sm btn-primary mr-3" title="專利發明2"
                                                        target="_blank">台灣證書</a>
                                                    <a href="{{ asset('img/aboutme/product/p2-c.pdf') }}" class="btn btn-sm btn-primary" title="專利發明2"
                                                        target="_blank">大陸證書</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title">手寫板 - flair2</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/flair2.jpg') }}" data-toggle="lightbox" data-title="手寫板 - flair2"
                                                        data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/flair2.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                    <a href="{{ asset('img/aboutme/product/flair2-t.pdf') }}" class="btn btn-sm btn-primary mr-3"
                                                        title="手寫板 - flair2" target="_blank">產品型錄</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title">HP Executive Tablet Pen R2 ODM Project</h3>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ asset('img/aboutme/product/hppen.jpg') }}" data-toggle="lightbox"
                                                        data-title="HP Executive Tablet Pen R2 ODM Project" data-gallery="gallery">
                                                        <img class="img-fluid" src="{{ asset('img/aboutme/product/hppen.jpg') }}" alt="Photo">
                                                    </a>
                                                </div>
                                                <div class="card-foot text-center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/dist/ekko-lightbox.css') }}">
@endsection

@section('script')
<script src="{{ asset('vendor/ekko-lightbox/dist/ekko-lightbox.min.js') }}"></script>
@endsection

@section('CustomScript')
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    })
</script>
@endsection
