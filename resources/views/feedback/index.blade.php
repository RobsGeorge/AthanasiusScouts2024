<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقييم معسكر مجمع 2025</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Keep your entire existing <style> block here */
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section (unchanged) -->
        <!-- ... -->

        <!-- Form Section -->
        <form id="evaluationForm" class="form" action="{{ route('feedback.create') }}" method="POST">
            @csrf

            <!-- Personal Information -->
            <div class="form-group">
                <label for="participantName" class="label">الاسم الثلاثي بالعربي</label>
                <input type="text" id="participantName" name="participant_name" class="input" placeholder="أدخل اسمك الثلاثي">
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
                    </select>
                </div>
            </div>

            <!-- Program Section -->
            <div class="section">
                <h2 class="section__title">
                    <span class="section__icon">🗓</span>
                    البرنامج العام
                </h2>
                <p class="section__description">
                    هذا القسم مخصص لتقييم البرنامج العام للمعسكر، من حيث التنظيم، المحتوى، وعدد الفقرات، ومواعيد الفقرات خلال اليوم والفعاليات المقدمة.
                </p>

                <div class="form-group">
                    <label class="label label--required">التقييم العام (1-10)</label>
                    <div class="rating">
                        @for ($i = 10; $i >= 1; $i--)
                            <input type="radio" id="program{{ $i }}" name="program_rating" value="{{ $i }}" class="rating__input" required>
                            <label for="program{{ $i }}" class="rating__label">★</label>
                        @endfor
                    </div>
                    <div class="rating__value" id="programRatingValue">اختر التقييم</div>
                </div>

                <div class="form-group">
                    <label for="programPros" class="label">الإيجابيات</label>
                    <textarea id="programPros" name="program_pros" class="textarea" placeholder="اذكر النقاط الإيجابية في البرنامج..."></textarea>
                </div>

                <div class="form-group">
                    <label for="programCons" class="label">السلبيات والتحسينات المقترحة</label>
                    <textarea id="programCons" name="program_cons" class="textarea" placeholder="اذكر النقاط التي تحتاج تحسين واقتراحاتك..."></textarea>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="submit-section">
                <button type="submit" class="btn btn--primary">إرسال التقييم</button>
                <button type="button" class="btn btn--secondary" onclick="downloadForm()">تحميل النموذج</button>
            </div>
        </form>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal__content">
            <div class="modal__icon">✅</div>
            <h2 class="modal__title">تم الإرسال بنجاح!</h2>
            <p class="modal__text">شكراً لك على وقتك ومشاركتك الصادقة. تقييمك سيساعدنا في تطوير المعسكرات القادمة.</p>
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
                    valueDisplay.textContent = `${value}/10`;
                }
            });
        });

        // AJAX Form submission
        document.getElementById('evaluationForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const form = this;
            const submitBtn = form.querySelector('.btn--primary');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جاري الإرسال...';
            submitBtn.disabled = true;

            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                    document.getElementById('programRatingValue').textContent = "اختر التقييم";
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
            document.getElementById('successModal').classList.add('modal--visible');
        }

        function closeModal() {
            document.getElementById('successModal').classList.remove('modal--visible');
        }

        // Download form function
        function downloadForm() {
            const formData = new FormData(document.getElementById('evaluationForm'));
            const data = {};

            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }

            const content = `تقييم معسكر مجمع 2025
            
الاسم: ${data.participant_name || 'غير محدد'}
الفريق الأساسي: ${data.main_team || 'غير محدد'}
الفريق الفرعي: ${data.sub_team || 'غير محدد'}

تقييم البرنامج: ${data.program_rating || 'غير محدد'}/10
الإيجابيات: ${data.program_pros || 'غير محدد'}
السلبيات: ${data.program_cons || 'غير محدد'}
            `;

            const blob = new Blob([content], { type: 'text/plain;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `تقييم_معسكر_${new Date().toISOString().split('T')[0]}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>