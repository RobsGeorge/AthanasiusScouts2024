<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href={{ asset('img/shamandora.png') }}>
    <title>تقييم معسكر مجمع 2025</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary-color: #333;
        --secondary-color: #555;
        --accent-color: #007bff;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --dark-gray: #6c757d;
        --border-color: #dee2e6;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px;
        direction: rtl;
        color: var(--primary-color);
        line-height: 1.6;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    /* Header Section */
    .header {
        background: linear-gradient(135deg, var(--light-gray) 0%, #ffffff 100%);
        padding: 40px 30px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .header__logo {
        max-width: 100px;
        margin-bottom: 20px;
        border-radius: 50%;
    }

    .header__title {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: var(--primary-color);
        font-weight: 700;

    }

    .header__subtitle {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
    }

    .header__description {
        font-size: 1.1rem;
        color: var(--dark-gray);
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .info-section {
        background: rgba(0, 123, 255, 0.05);
        border: 1px solid rgba(0, 123, 255, 0.1);
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 20px;
        text-align: right;
    }

    .info-section__title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 15px;
        display: flex;
        align-items: center;

    }

    .info-section__icon {
        margin-left: 10px;
        font-size: 1.5rem;
    }

    .info-section__list {
        list-style: none;
        padding: 0;
    }

    .info-section__item {
        margin-bottom: 8px;
        padding-right: 20px;
        position: relative;
    }

    .info-section__item::before {
        content: "•";
        position: absolute;
        right: 0;
        color: var(--accent-color);
        font-weight: bold;
    }

    .notice {
        background: rgba(255, 193, 7, 0.1);
        border: 1px solid rgba(255, 193, 7, 0.3);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-top: 20px;
        font-weight: 600;
        color: var(--primary-color);
    }

    /* Form Section */
    .form {
        padding: 40px 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group--inline {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .label--required::after {
        content: " *";
        color: var(--danger-color);
    }

    .input,
    .textarea,
    .select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-family: inherit;
        transition: var(--transition);
        background: white;
    }

    .input:focus,
    .textarea:focus,
    .select:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .textarea {
        resize: vertical;
        min-height: 100px;
    }

    .select {
        cursor: pointer;
    }

    /* Section Styles */
    .section {
        margin-bottom: 40px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 30px;
        background: var(--light-gray);
        transition: var(--transition);
    }

    .section:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .section__title {
        font-size: 1.8rem;
        color: var(--primary-color);
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;

    }

    .section__icon {
        margin-left: 12px;
        font-size: 1.5rem;
    }

    .section__description {
        color: var(--dark-gray);
        margin-bottom: 25px;
        font-size: 1.05rem;
        line-height: 1.6;
    }



    /* Rating System */
    .rating-stars {
        direction: rtl;
        unicode-bidi: bidi-override;
        display: inline-block;
        font-size: 2rem;
        user-select: none;
    }

    .rating-stars input[type="radio"] {
        display: none;
    }

    .rating-stars label {
        color: var(--medium-gray);
        cursor: pointer;
        transition: var(--transition);
    }

    .rating-stars input:checked~label,
    .rating-stars label:hover,
    .rating-stars label:hover~label {
        color: #ffc107;
    }

    .rating__input {
        display: none;
    }

    .rating__label {
        font-size: 2rem;
        color: var(--medium-gray);
        cursor: pointer;
        transition: var(--transition);
        padding: 5px;
    }

    .rating__label:hover,
    .rating_label:hover~.rating_label,
    .rating_input:checked~.rating_label {
        color: #ffd700;
        transform: scale(1.1);
    }

    .rating__value {
        text-align: center;
        margin-top: 10px;
        font-weight: 600;
        color: var(--primary-color);
    }

    /* Submit Section */
    .submit-section {
        padding: 40px 30px;
        background: var(--light-gray);
        border-top: 1px solid var(--border-color);
        text-align: center;
    }

    .btn {
        padding: 15px 30px;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-block;
        margin: 0 10px;
    }

    .btn--primary {
        background: var(--primary-color);
        color: white;
    }

    .btn--primary:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn--secondary {
        background: var(--accent-color);
        color: white;
    }

    .btn--secondary:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    .modal--visible {
        display: flex;
    }

    .modal__content {
        background: white;
        padding: 40px;
        border-radius: var(--border-radius);
        text-align: center;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: modalAppear 0.3s ease;
    }

    @keyframes modalAppear {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .modal__icon {
        font-size: 4rem;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal__title {
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: var(--primary-color);
    }

    .modal__text {
        color: var(--dark-gray);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 10px;
        }

        .container {
            margin: 0;
        }

        .header,
        .form,
        .submit-section {
            padding: 20px;
        }

        .header__title {
            font-size: 2rem;
        }

        .form-group--inline {
            grid-template-columns: 1fr;
        }

        .section {
            padding: 20px;
        }

        .section__title {
            font-size: 1.5rem;
        }

        .rating__label {
            font-size: 1.5rem;
        }

        .modal__content {
            padding: 30px 20px;
        }

        .btn {
            display: block;
            margin: 10px auto;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .header__title {
            font-size: 1.7rem;
        }

        .info-section,
        .section {
            padding: 15px;
        }

        .rating {
            gap: 2px;
        }

        .rating__label {
            font-size: 1.3rem;
            padding: 3px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <img src={{ asset('img/shamandora.png') }} alt="شعار المعسكر" class="header__logo">
            <h1 class="header__title">تقييم معسكر مجمع 2025 - مربوط بكيفي</h1>
            <p class="header__subtitle">ربنا يعوضكم على تعبكم وخدمتكم خلال المعسكر</p>
            <p class="header__description">
                وجودكم كان بركة حقيقية، ومجهودكم هو اللي صنع الفرق. علشان نستفيد فعلاً من تجربة المعسكر وننمو كفريق،
                بنطلب منكم تشاركونا آرائكم الصادقة عن كل حاجة حصلت — الإيجابي، والتحديات، وكل التفاصيل اللي تهم.
            </p>

            <div class="info-section">
                <h3 class="info-section__title">
                    <span class="info-section__icon">🎯</span>
                    هدف التقييم
                </h3>
                <ul class="info-section__list">
                    <li class="info-section__item">إننا نتعلم من التجربة دي ونبني عليها</li>
                    <li class="info-section__item">نتجنب أي تقصير حصل خلال المعسكر</li>
                    <li class="info-section__item">نسجل النقاط المهمة علشان تكون مرجعية لينا بعد كده</li>
                    <li class="info-section__item">ونوفر وقت لما نقعد مع بعض نراجع ونخطط للجايات</li>
                </ul>
            </div>

            <div class="info-section">
                <h3 class="info-section__title">
                    <span class="info-section__icon">📝</span>
                    رجاء خاص
                </h3>
                <ul class="info-section__list">
                    <li class="info-section__item">اكتب رأيك بموضوعية</li>
                    <li class="info-section__item">كن صادق وبنّاء في ملاحظاتك</li>
                    <li class="info-section__item">الهدف مش اللوم، الهدف هو دايمًا التطوير والتحسين</li>
                </ul>
            </div>

            <p class="header__description">
                شكراً ليك من القلب — وجودك فرق معانا ❤<br>
                وبإذن الله المعسكر الجاي يكون أقوى وأجمل بينا كلنا
            </p>

            <div class="notice">
                يرجى العلم أن اغلب الحقول في هذا النموذج اختيارية. يمكنك ملء ما تراه مناسباً وإرسال النموذج في أي وقت.
            </div>
        </header>

        <!-- Form Section -->
        <form id="evaluationForm" class="form" action="/feedback" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Personal Information -->
            <div class="form-group">
                <label for="participantName" class="label">الاسم الثلاثي بالعربي</label>
                <input type="text" id="participantName" name="participant_name" class="input"
                    placeholder="أدخل اسمك الثلاثي">
            </div>

            <div class="form-group form-group--inline">
                <div>
                    <label for="mainTeam" class="label">الفريق الأساسي</label>
                    <select id="mainTeam" name="main_team" class="select">
                        <option value="">اختر الفريق الأساسي</option>
                        <option value="braem">براعم</option>
                        <option value="ashbal">أشبال</option>
                        <option value="zahrat">زهرات</option>
                        <option value="kashafa">كشافة</option>
                        <option value="morshedat">مرشدات</option>
                        <option value="motakadem">متقدم</option>
                        <option value="raedat">رائدات</option>
                        <option value="jawala">جوالة</option>
                        <option value="edareat">اداريات</option>
                    </select>
                </div>
                <div>
                    <label for="subTeam" class="label">الفريق الفرعي</label>
                    <select id="subTeam" name="sub_team" class="select">
                        <option value="">اختر الفريق الفرعي</option>
                        <option value="media">ميديا</option>
                        <option value="ohda">عهدة</option>
                        <option value="esafate">إسعافات</option>
                        <option value="secretary">سكرتارية</option>
                        <option value="moshtaryat">مشتريات</option>
                        <option value="malia">مالية</option>
                        <option value="matbakh">مطبخ</option>
                        <option value="tawselhadaf">توصيل هدف</option>
                        <option value="bernameg">برنامج</option>
                    </select>
                </div>
            </div>

            <!-- Program Section -->
            <div class="section">

                <h2 class="section__title">

                    🗓️ البرنامج العام
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم البرنامج العام للمعسكر، من حيث التنظيم، المحتوى، وعدد الفقرات، ومواعيد الفقرات
                    خلال اليوم والفعاليات المقدمة.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="program{{ $i }}" name="program_rating" value="{{ $i }}" required>
                        <label for="program{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="programPros" class="label">الإيجابيات</label>
                    <textarea id="programPros" name="program_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في البرنامج..."></textarea>
                </div>

                <div class="form-group">
                    <label for="programCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="programCons" name="program_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>


            <!-- Leaders Section -->
            <div class="section">
                <h2 class="section__title">

                    👥 توزيع القادة
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم عملية توزيع القادة على الفرق، ومدى فعالية كل قائد في إدارة فريقه، والتواصل مع
                    الأعضاء، وتقديم الدعم اللازم.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="leaders{{ $i }}" name="leaders_rating" value="{{ $i }}" required>
                        <label for="leaders{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="leadersPros" class="label">الإيجابيات</label>
                    <textarea id="leadersPros" name="leaders_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في توزيع القادة..."></textarea>
                </div>

                <div class="form-group">
                    <label for="leadersCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="leadersCons" name="leaders_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>


            <!-- Games Section -->
            <div class="section">
                <h2 class="section__title">

                    🎮 الألعاب
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم الألعاب والأنشطة الترفيهية المقدمة من لجنة الألعاب خلال المعسكر، من حيث انواع
                    الألعاب، الفائدة، والتنظيم.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="games{{ $i }}" name="games_rating" value="{{ $i }}" required>
                        <label for="games{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="gamesPros" class="label">الإيجابيات</label>
                    <textarea id="gamesPros" name="games_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في الالعاب..."></textarea>
                </div>

                <div class="form-group">
                    <label for="gamesCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="gamesCons" name="games_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>


            <!-- goal_delivery Section -->
            <div class="section">
                <h2 class="section__title">

                    🎯 توصيل الهدف
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم طريقة توصيل هدف المعسكر، المحتوى، أماكن المحاضرات، مدة الفقرة، الأنشطة المقدمة
                    فى توصيل الهدف
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="goal_delivery{{ $i }}" name="goal_delivery_rating" value="{{ $i }}"
                            required>
                        <label for="goal_delivery{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="goal_deliveryPros" class="label">الإيجابيات</label>
                    <textarea id="goal_deliveryPros" name="goal_delivery_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في توصيل الهدف..."></textarea>
                </div>

                <div class="form-group">
                    <label for="goal_deliveryCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="goal_deliveryCons" name="goal_delivery_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>


            <!-- logo Section -->
            <div class="section">
                <h2 class="section__title">

                    🎵 الشعار
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم الشعار الخاص بالمعسكر أو الفعالية، من حيث الكلمات، اللحن، الوضوح، والجاذبية.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="logo{{ $i }}" name="logo_rating" value="{{ $i }}" required>
                        <label for="logo{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="logoPros" class="label">الإيجابيات</label>
                    <textarea id="logoPros" name="logo_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في الشعار..."></textarea>
                </div>

                <div class="form-group">
                    <label for="logoCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="logoCons" name="logo_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- gift Section -->
            <div class="section">
                <h2 class="section__title">

                    🎁 الهدايا
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم الهدايا المقدمة، من حيث الجودة، الملائمة، والقيمة.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="gift{{ $i }}" name="gift_rating" value="{{ $i }}" required>
                        <label for="gift{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="giftPros" class="label">الإيجابيات</label>
                    <textarea id="giftPros" name="gift_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في الهدايا..."></textarea>
                </div>

                <div class="form-group">
                    <label for="giftCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="giftCons" name="gift_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- secretary Section -->
            <div class="section">
                <h2 class="section__title">

                    📋 السكرتارية
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم أعمال السكرتارية، من حيث توزيع الخيم، والرهوط، والباصات، الدقة، وسرعة الإنجاز،
                    ومرونة القادة خلال الحجز والتوزيع والتغيرات.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="secretary{{ $i }}" name="secretary_rating" value="{{ $i }}" required>
                        <label for="secretary{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="secretaryPros" class="label">الإيجابيات</label>
                    <textarea id="secretaryPros" name="secretary_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في السكرتارية..."></textarea>
                </div>

                <div class="form-group">
                    <label for="secretaryCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="secretaryCons" name="secretary_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- media Section -->
            <div class="section">
                <h2 class="section__title">

                    📱 الميديا
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم التغطية الإعلامية، من حيث الجودة، التنوع، والانتشار.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="media{{ $i }}" name="media_rating" value="{{ $i }}" required>
                        <label for="media{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="mediaPros" class="label">الإيجابيات</label>
                    <textarea id="mediaPros" name="media_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في الميديا..."></textarea>
                </div>

                <div class="form-group">
                    <label for="mediaCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="mediaCons" name="media_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- emergency Section -->
            <div class="section">
                <h2 class="section__title">

                    🚑 الاسعافات
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم خدمات الإسعافات الأولية، من حيث الاستجابة، التجهيزات، وكفاءة الفريق،
                    والانتشار.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="emergency{{ $i }}" name="emergency_rating" value="{{ $i }}" required>
                        <label for="emergency{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="emergencyPros" class="label">الإيجابيات</label>
                    <textarea id="emergencyPros" name="emergency_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في الاسعافات..."></textarea>
                </div>

                <div class="form-group">
                    <label for="emergencyCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="emergencyCons" name="emergency_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- kitchen Section -->
            <div class="section">
                <h2 class="section__title">

                    🍽️ المطبخ
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم خدمات المطبخ والطعام، من حيث الجودة، النظافة، والتنوع، والكميات.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="kitchen{{ $i }}" name="kitchen_rating" value="{{ $i }}" required>
                        <label for="kitchen{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="kitchenPros" class="label">الإيجابيات</label>
                    <textarea id="kitchenPros" name="kitchen_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في المطبخ..."></textarea>
                </div>

                <div class="form-group">
                    <label for="kitchenCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="kitchenCons" name="kitchen_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- finance Section -->
            <div class="section">
                <h2 class="section__title">

                    💰 المالية
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم قطاع المالية، من حيث التنظيم، الكفاءة، ومرونة القادة خلال الحجز.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="finance{{ $i }}" name="finance_rating" value="{{ $i }}" required>
                        <label for="finance{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="financePros" class="label">الإيجابيات</label>
                    <textarea id="financePros" name="finance_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في المالية..."></textarea>
                </div>

                <div class="form-group">
                    <label for="financeCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="financeCons" name="finance_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- custody Section -->
            <div class="section">
                <h2 class="section__title">

                    📦 العهدة
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم قطاع العهدة، من حيث التنظيم، والتسليم والتسلم، الإنتشار، وسرعة الإستجابة.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="custody{{ $i }}" name="custody_rating" value="{{ $i }}" required>
                        <label for="custody{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="custodyPros" class="label">الإيجابيات</label>
                    <textarea id="custodyPros" name="custody_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في العهدة..."></textarea>
                </div>

                <div class="form-group">
                    <label for="custodyCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="custodyCons" name="custody_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- purchase Section -->
            <div class="section">
                <h2 class="section__title">

                    🛒 المشتريات
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم عملية المشتريات، من حيث الكفاءة، الجودة، وتلبية الاحتياجات.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="purchase{{ $i }}" name="purchase_rating" value="{{ $i }}" required>
                        <label for="purchase{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="purchasePros" class="label">الإيجابيات</label>
                    <textarea id="purchasePros" name="purchase_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في المشتريات..."></textarea>
                </div>

                <div class="form-group">
                    <label for="purchaseCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="purchaseCons" name="purchase_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- transportation Section -->
            <div class="section">
                <h2 class="section__title">
                    <span class="section__icon"></span>
                    🚌 المواصلات
                </h2>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating-stars">
                        @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="transportation{{ $i }}" name="transportation_rating" value="{{ $i }}"
                            required>
                        <label for="transportation{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>

                <div class="form-group">
                    <label for="transportationPros" class="label">الإيجابيات</label>
                    <textarea id="transportationPros" name="transportation_pros" class="textarea"
                        placeholder="اذكر النقاط الإيجابية في المواصلات..."></textarea>
                </div>

                <div class="form-group">
                    <label for="transportationCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="transportationCons" name="transportation_cons" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <div class="section">
                <div class="form-group">
                    <label for="generalSuggestions" class="label">هل لديك اي اقتراحات عامة؟ من فضلك اكتبها هنا</label>
                    <textarea id="generalSuggestions" name="general_suggestions" class="textarea"
                        placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="submit-section">
                <button type="submit" class="btn btn--primary">إرسال التقييم</button>
            </div>
        </form>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal__content">
            <div class="modal__icon">
                <img src="img/shamandora.png" alt="Success Icon" style="max-width: 100px; height: auto;">
            </div>
            <h2 class="modal__title" id="modalTitle">تم الإرسال بنجاح!</h2>
            <p class="modal__text" id="modalText">شكراً لك على وقتك ومشاركتك الصادقة. تقييمك سيساعدنا في تطوير المعسكرات
                القادمة.</p>
            <button class="btn btn--primary" onclick="closeModal()">إغلاق</button>
        </div>
    </div>


    <script>
    // Rating system functionality
    document.querySelectorAll('.rating__input').forEach(input => {
        input.addEventListener('change', function() {
            const value = this.value;
            const valueDisplay = this.closest('.form-group').querySelector('.rating__value');
            if (valueDisplay) {
                valueDisplay.textContent = `${value}`;

            }
        });
    });

    // Form submission
    document.getElementById('evaluationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = this;
        const submitBtn = form.querySelector('.btn--primary');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'جاري الإرسال...';
        submitBtn.disabled = true;

        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            if (response.ok) {
                showModal();
                form.reset();
            } else {
                alert('حدث خطأ أثناء الإرسال. حاول مرة أخرى.');
            }
        } catch (error) {
            alert('فشل الاتصال بالخادم.');
        }

        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });


    // Modal functions
    function showModal() {
        // Get the participant name from the form
        const participantName = document.getElementById('participantName').value.trim();
        const modalTitle = document.getElementById('modalTitle');
        const modalText = document.getElementById('modalText');

        if (participantName) {
            modalTitle.textContent = `شكراً يا ${participantName} ❤️`;
            modalText.textContent =
                `تم تقديم رأيك بنجاح! شكراً لك على وقتك ومشاركتك الصادقة. تقييمك سيساعدنا في تطوير المعسكرات القادمة.`;
        } else {
            modalTitle.textContent = `شكراً لك ❤️`;
            modalText.textContent =
                `تم تقديم رأيك بنجاح! شكراً لك على وقتك ومشاركتك الصادقة. تقييمك سيساعدنا في تطوير المعسكرات القادمة.`;
        }

        document.getElementById('successModal').classList.add('modal--visible');
    }

    function closeModal() {
        document.getElementById('successModal').classList.remove('modal--visible');
    }

    // Close modal on outside click
    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Keyboard navigation for modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    </script>
</body>

</html>