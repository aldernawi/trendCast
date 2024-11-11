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
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $selectedUserId ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
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
