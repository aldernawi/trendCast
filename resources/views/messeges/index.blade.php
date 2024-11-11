<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرسائل</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        h2, h3 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .message-container {
            overflow-y: auto;
            flex-grow: 1;
            padding-bottom: 20px;
        }
        .message {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            position: relative;
            max-width: 70%;
            display: flex;
            align-items: center;
        }
        .message strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .message p {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
        }
        .message small {
            position: absolute;
            bottom: -20px;
            font-size: 12px;
        }
        .message-client {
            background-color: #e9f5fb;
            align-self: flex-start;
            margin-left: auto;
        }
        .message-client strong {
            color: #007bff;
        }
        .message-company {
            background-color: #f1f0f0;
            align-self: flex-end;
            margin-right: auto;
        }
        .message-company strong {
            color: #6c757d;
        }
        .message small {
            color: #888;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .input-group {
            display: flex;
            margin-bottom: 20px;
        }
        .input-group textarea {
            border-radius: 20px;
            padding: 15px;
            width: 100%;
            resize: none;
            border: 1px solid #ced4da;
        }
        .input-group button {
            margin-left: 10px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <div wire:poll>
                <div>
                    <h2>الرسائل</h2>
        
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
        
                    <!-- اختيار المستخدم لعرض المحادثة معه -->
                    <form method="GET" action="{{ route('messages.index') }}">
                        <div class="form-group">
                            <label for="user_id">اختر المستخدم</label>
                            <select id="user_id" name="user_id" class="form-control" onchange="this.form.submit()">
                                <option value="">اختر مستخدمًا</option>
                                @if(Auth::user()->user_type === 'Company' || Auth::user()->user_type === 'Freelancer')
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            @else
                                @foreach ($companiesAndFreelancers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </form>
        
                    <!-- عرض الرسائل -->
                    <div class="message-container" id="message-container">
                        @foreach ($messages as $msg)
                            <div class="message {{ $msg->sender_id == Auth::id() ? 'message-client' : 'message-company' }}">
                                <strong>{{ $msg->sender->name }}:</strong>
                                <p>{{ $msg->message }}</p>
                                <small>{{ $msg->created_at->format('d-m-Y H:i') }}</small>
                            </div>
        
                            @if (Auth::user()->user_type === 'Company' || Auth::user()->user_type === 'Freelancer')
                            @if ($msg->receiver_id == Auth::id())
                                <div class="message-reply">
                                    <form action="{{ route('messages.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="{{ $msg->sender_id }}">
                                        <input type="hidden" name="original_message_id" value="{{ $msg->id }}">
                                        <div class="input-group">
                                            <textarea id="reply_message" name="message" rows="2" placeholder="اكتب ردك هنا..." required></textarea>
                                            <button type="submit" class="btn btn-secondary">رد</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
        
                    @if(Auth::user()->user_type === 'Client' && $selectedUserId)
                    <form action="{{ route('messages.store') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $selectedUserId }}">
                        <div class="form-group">
                            <label for="message">نص الرسالة</label>
                            <div class="input-group">
                                <textarea id="message" name="message" class="form-control" rows="3" required placeholder="اكتب رسالتك هنا..."></textarea>
                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
            </div>
    <script src="{{ asset('js/app.js') }}"></script>
@livewireScripts

<script>
    // حفظ محتوى الرسالة عند كل تعديل
    document.getElementById('message').addEventListener('input', function() {
        localStorage.setItem('draftMessage', this.value);
    });

    // حفظ محتوى الريبلاي مسج عند كل تعديل
    document.getElementById('reply_message').addEventListener('input', function() {
        localStorage.setItem('draftReplyMessage', this.value);
    });

    // استعادة محتوى الرسالة بعد رفرش الصفحة
    window.addEventListener('load', function() {
        const savedMessage = localStorage.getItem('draftMessage');
        if (savedMessage) {
            document.getElementById('message').value = savedMessage;
        }

        // استعادة محتوى الريبلاي مسج بعد رفرش الصفحة
        const savedReplyMessage = localStorage.getItem('draftReplyMessage');
        if (savedReplyMessage) {
            document.getElementById('reply_message').value = savedReplyMessage;
        }
    });

    // حفظ موقع التمرير قبل تحديث الصفحة
    window.addEventListener('beforeunload', function() {
        localStorage.setItem('scrollPosition', window.scrollY);
    });

    // استعادة موقع التمرير بعد رفرش الصفحة
    window.addEventListener('load', function() {
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
        } else {
            // إذا لم يتم حفظ موقع التمرير، اسكرول إلى أسفل الصفحة
            window.scrollTo(0, document.body.scrollHeight);
        }
    });
</script>

<script>
    // عمل رفرش للصفحة كل 10 ثواني
    setInterval(function() {
        window.location.reload();
    }, 10000); // 10000 ميلي ثانية تساوي 10 ثواني

    // عند تحميل الصفحة، قم بعمل سكرول تلقائي إلى أسفل الصفحة
    window.addEventListener('load', function() {
        window.scrollTo(0, document.body.scrollHeight);
    });
</script>




</body>
</html>
