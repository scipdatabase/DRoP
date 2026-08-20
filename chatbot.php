<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #chatBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 25px;
            border-radius: 50px;
            background: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            font-family: sans-serif;
        }

        #chatContainer {
            position: fixed;
            bottom: 85px;
            right: 20px;
            width: 340px;
            height: 500px;
            display: none;
            flex-direction: column;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            background: #fff;
            z-index: 2000;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: slideUp 0.3s ease-out;
            transition: width 0.3s ease, height 0.3s ease, bottom 0.3s ease, top 0.3s ease;
        }

        #chatContainer.maximized {
            width: 550px;
            height: auto;
            top: 90px;
            bottom: 20px;
            z-index: 9999 !important;
        }

        #chatContainer.minimized {
            height: 52px !important;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-actions span {
            cursor: pointer;
            font-size: 1.1rem;
            margin-left: 12px;
            opacity: 0.85;
            transition: opacity 0.2s;
            display: inline-block;
        }

        .chat-actions span:hover {
            opacity: 1;
        }

        #chatContentWrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow: hidden;
        }

        #chatBody {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .msg {
            padding: 8px 12px;
            border-radius: 12px;
            max-width: 85%;
            font-size: 0.9rem;
            word-wrap: break-word;
        }

        .bot {
            align-self: flex-start;
            background: #e9ecef;
            color: #333;
        }

        .user {
            align-self: flex-end;
            background: #0d6efd;
            color: white;
        }

        .error-msg {
            align-self: flex-start;
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .sources-tag {
            display: block;
            margin-top: 6px;
            font-size: 0.75rem;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }

        #suggestions {
            padding: 10px;
            background: #fff;
            border-top: 1px solid #eee;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .suggest-btn {
            background: #e7f1ff;
            color: #0d6efd;
            border: 1px solid #0d6efd;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .suggest-btn:hover {
            background: #0d6efd;
            color: white;
        }

        #chatFooter {
            padding: 12px;
            border-top: 1px solid #eee;
            background: #fff;
        }
    </style>
</head>

<body>

    <button id="chatBtn"><strong>💬 ChatBot</strong></button>

    <div id="chatContainer">
        <div id="chatHeader" style="background:#0d6efd; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center; user-select: none;">
            <span><strong>DRoP Assistant</strong></span>
            <div class="chat-actions">
                <span id="minimizeChat" title="Minimize">&minus;</span>
                <span id="maximizeChat" title="Maximize">&#128465;</span>
                <span id="closeChat" title="Close">&times;</span>
            </div>
        </div>

        <div id="chatContentWrapper">
            <div id="chatBody"></div>

            <div id="suggestions">
                <button class="suggest-btn" onclick="sendSuggestion('What is DRR?')">What is DRR?</button>
                <button class="suggest-btn" onclick="sendSuggestion('Symptoms')">Symptoms</button>
                <button class="suggest-btn" onclick="sendSuggestion('Management')">Management</button>
            </div>
            <div style="text-align:center; font-size:11px; color:#888; margin-top:4px; background: #fff;">
                ⚠️ AI-generated responses may contain errors. Please verify information.
            </div>

            <div id="chatFooter">
                <input type="text" id="chatInput" placeholder="Type your question here..." autocomplete="off" style="width:100%; border:none; outline:none;">
            </div>
        </div>
    </div>

    <script>
        const chatBtn = document.getElementById("chatBtn");
        const chatContainer = document.getElementById("chatContainer");
        const chatContentWrapper = document.getElementById("chatContentWrapper");
        const closeChat = document.getElementById("closeChat");
        const minimizeChat = document.getElementById("minimizeChat");
        const maximizeChat = document.getElementById("maximizeChat");
        const chatInput = document.getElementById("chatInput");
        const chatBody = document.getElementById("chatBody");

        const API_CHAT_ENDPOINT = "https://drr.nipgr.ac.in/chatbot/ask";

        chatBtn.onclick = () => {
            chatContainer.classList.remove('minimized');
            chatContentWrapper.style.display = "flex";
            chatContainer.style.display = "flex";
        };

        closeChat.onclick = (e) => {
            e.stopPropagation();
            chatContainer.style.display = "none";
        };

        minimizeChat.onclick = (e) => {
            e.stopPropagation();
            if (chatContainer.classList.contains('minimized')) {
                chatContainer.classList.remove('minimized');
                chatContentWrapper.style.display = "flex";
                minimizeChat.innerHTML = "&minus;";
                minimizeChat.setAttribute("title", "Minimize");
            } else {
                chatContainer.classList.add('minimized');
                chatContentWrapper.style.display = "none";
                minimizeChat.innerHTML = "&#128464;";
                minimizeChat.setAttribute("title", "Restore");
            }
        };

        maximizeChat.onclick = (e) => {
            e.stopPropagation();
            if (chatContainer.classList.contains('minimized')) {
                chatContainer.classList.remove('minimized');
                chatContentWrapper.style.display = "flex";
                minimizeChat.innerHTML = "&minus;";
            }

            if (chatContainer.classList.contains('maximized')) {
                chatContainer.classList.remove('maximized');
                maximizeChat.innerHTML = "&#128465;";
                maximizeChat.setAttribute("title", "Maximize");
            } else {
                chatContainer.classList.add('maximized');
                maximizeChat.innerHTML = "&#128466;";
                maximizeChat.setAttribute("title", "Demaximize");
            }
            chatBody.scrollTop = chatBody.scrollHeight;
        };

        window.addEventListener('load', () => {
            setTimeout(() => {
                chatContainer.style.display = "flex";
                addMessage("bot", "Hello 👋 I am your DROP assistant. How can I help you today?");
            }, 500);
        });

        chatInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter" && chatInput.value.trim() !== "") {
                sendMessage(chatInput.value.trim());
                chatInput.value = "";
            }
        });

        function sendSuggestion(text) {
            sendMessage(text);
        }

        function sendMessage(text) {
            addMessage("user", text);

            const typingId = "typing-" + Date.now();
            addMessage("bot", "<i>Typing...</i>", typingId);

            fetch(API_CHAT_ENDPOINT, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        question: text
                    })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Server returned status " + res.status);
                    }
                    return res.json();
                })
                .then(data => {
                    const typingIndicator = document.getElementById(typingId);
                    if (typingIndicator) typingIndicator.remove();

                    let responseText = data.answer || "I couldn't process an answer.";
                    let html = `<span>${responseText}</span>`;

                    if (data.sources && data.sources.length > 0) {
                        html += `<span class="sources-tag">📚 ${data.sources.join(' · ')}</span>`;
                    }

                    addMessage("bot", html);
                })
                .catch(err => {
                    console.error("Fetch Error:", err);
                    const typingIndicator = document.getElementById(typingId);

                    if (typingIndicator) {
                        typingIndicator.className = "msg error-msg";
                        typingIndicator.removeAttribute("id");
                        typingIndicator.innerHTML = "⚠️ Sorry, I can't reach the server right now. Please make sure the API server is running.";
                    } else {
                        addMessage("error-msg", "⚠️ Connectivity lost. Unable to complete request.");
                    }
                });
        }

        function addMessage(sender, text, id = null) {
            const msgDiv = document.createElement("div");
            msgDiv.className = `msg ${sender}`;
            if (id) msgDiv.id = id;
            msgDiv.innerHTML = text;
            chatBody.appendChild(msgDiv);

            chatBody.scrollTop = chatBody.scrollHeight;
        }
    </script>
</body>

</html>
