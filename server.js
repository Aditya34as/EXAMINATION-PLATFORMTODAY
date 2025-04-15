const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
require('dotenv').config(); // ✅ Load .env file

// ✅ Async-compatible fetch for CommonJS:
const fetch = (...args) => import('node-fetch').then(({ default: fetch }) => fetch(...args));

const app = express();
const PORT = 5000;

app.use(cors());
app.use(bodyParser.json());

app.post("/chat", async (req, res) => {
  const userMessage = req.body.message;
  console.log("🟢 Incoming message:", userMessage);

  try {
    const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${process.env.OPENROUTER_API_KEY}` // ✅ From .env
      },
      body: JSON.stringify({
        model: "openai/gpt-3.5-turbo",
        messages: [
          { role: "system", content: "You are a helpful assistant." },
          { role: "user", content: userMessage }
        ]
      })
    });

    const data = await response.json();
    console.log("🔎 API Response:", data);

    const botReply = data.choices?.[0]?.message?.content || "❌ No reply received.";
    res.json({ reply: botReply });

  } catch (error) {
    console.error("🔴 OpenRouter API Error:", error);
    res.status(500).json({ reply: "Bot: An error occurred. Please check your internet connection." });
  }
});

app.listen(PORT, () => {
  console.log(`✅ Server is running on http://localhost:${PORT}`);
});
