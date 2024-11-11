
    <div wire:poll>
        <div class="container">
            <h2>الرسائل</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Messages -->
            <div class="message-container" id="message-container">
                @foreach ($messages as $msg)
                    <div class="message {{ $msg->sender_id == Auth::id() ? 'message-client' : 'message-company' }}">
                        <strong>{{ $msg->sender->name }}:</strong>
                        <p>{{ $msg->message }}</p>
                        <small>{{ $msg->created_at->format('d-m-Y H:i') }}</small>
                    </div>

                    <!-- Form for replying to a message (visible only to the company) -->
                    @if ($msg->receiver_id == Auth::id() && Auth::user()->user_type === 'Company')
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

            <!-- Form for sending a message (visible only to the client) -->
            @if(Auth::user()->user_type === 'Client')
            <form action="{{ route('messages.store') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <div class="form-group">
                    <label for="receiver_id">المرسل إليه</label>
                    <select id="receiver_id" name="receiver_id" class="form-control" required wire:model="selectedReceiverId">
                        <option value="">اختر مرسل إليه</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
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

<div>
    <div wire:poll>
        <div class="container">
            <h2>الرسائل</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Messages -->
            <div class="message-container" id="message-container">
                @foreach ($messages as $msg)
                    <div class="message {{ $msg->sender_id == Auth::id() ? 'message-client' : 'message-company' }}">
                        <strong>{{ $msg->sender->name }}:</strong>
                        <p>{{ $msg->message }}</p>
                        <small>{{ $msg->created_at->format('d-m-Y H:i') }}</small>
                    </div>

                    <!-- Form for replying to a message (visible only to the company) -->
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

            @if(Auth::user()->user_type === 'Client')
            <form action="{{ route('messages.store') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <div class="form-group">
                    <label for="receiver_id">المرسل إليه</label>
                    <select id="receiver_id" name="receiver_id" class="form-control" required wire:model="selectedReceiverId">
                        <option value="">اختر مرسل إليه</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">نص الرسالة</label>
                    <div class="input-group">
                        <textarea id="message" name="message" class="form-control" rows="3" required placeholder="اكتب رسالتك هنا..."></textarea>
                        <button onclick="{{sendMessage()}}" class="btn btn-primary">إرسال</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
