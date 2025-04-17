# 📈 CheckMyStock

**CheckMyStock** is a sleek, modern, and fully functional stock analysis web application. It fetches real-time financial data and metrics for any publicly listed company using multiple APIs and calculates key financial ratios like BVPS, ROIC, Debt-to-Equity, and P/E automatically.

🌐 **Live Demo:** [checkmystock.gmsahimsa.com](https://checkmystock.gmsahimsa.com)


<img width="1906" alt="image" src="https://github.com/user-attachments/assets/cf91912a-a0fa-47c7-908a-d68aa3518231" />


---

## 🚀 Features

- 🔎 Search any stock by ticker (e.g., AAPL, NVDA, MSFT)
- 📊 Real-time market data including:
  - Company Name
  - Ticker
  - Current Price
  - Market Capitalization
  - Dividend Yield
  - 52-Week Range
- 📈 Calculated Financial Ratios:
  - **BVPS** (Book Value Per Share)
  - **Debt-to-Equity Ratio**
  - **ROIC** (Return on Invested Capital)
  - **P/E** (Price-to-Earnings Ratio)
- 🧠 Company description + top 10 similar stocks
- 🌍 RSS-powered market news (CNBC, Yahoo Finance, Investing.com)
- 💬 Financial tips and fun facts while loading
- 📤 Share buttons for WhatsApp, Facebook, Instagram, Email
- 🌙 Beautiful dark-themed UI with Bootstrap 5 and animations

---

## 🛠 Tech Stack

- **Frontend:** HTML, CSS (Bootstrap), JS
- **Backend:** PHP
- **Data APIs:**
  - [Financial Modeling Prep (FMP)](https://financialmodelingprep.com/)
  - [Alpha Vantage](https://www.alphavantage.co/)
- **News:** RSS Feeds (CNBC, Yahoo Finance, etc.)

---

## 📡 API Usage

### 📘 Financial Modeling Prep (FMP)
| Metric | Endpoint |
|--------|----------|
| Company Profile | `/api/v3/profile/{symbol}` |
| Similar Stocks | `/api/v3/stock/similar/{symbol}` |
| Balance Sheet | `/api/v3/balance-sheet-statement/{symbol}` |
| Income Statement | `/api/v3/income-statement/{symbol}` |
| Quote | `/api/v3/quote/{symbol}` |

🔑 [Get your FMP API key here](https://financialmodelingprep.com/developer/docs/pricing/)

---

### 📘 Alpha Vantage
| Metric | Endpoint |
|--------|----------|
| Company Overview | `function=OVERVIEW` |
| Price | `function=GLOBAL_QUOTE` |
| Balance Sheet | `function=BALANCE_SHEET` |
| Income Statement | `function=INCOME_STATEMENT` |
| Daily Prices | `function=TIME_SERIES_DAILY_ADJUSTED` (for 52-week range)

🔑 [Get your Alpha Vantage API key here](https://www.alphavantage.co/support/#api-key)

---

## 📦 Installation

### ⚙ Requirements
- PHP 7.4+
- Web server (Apache, Nginx, XAMPP)

### 🧑‍💻 Steps
1. Clone the repo:
   ```bash
   git clone https://github.com/A3H1M4SA/CheckMyStock.git
   cd CheckMyStock
