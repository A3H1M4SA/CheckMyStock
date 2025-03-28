<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckMyStock - Stock Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --dark-bg: #121212;
            --darker-bg: #1E1E1E;
            --card-bg: #2D2D2D;
            --card-header: #383838;
            --primary-color: #3498db;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --text-color: #f5f5f5;
            --text-muted: #aaaaaa;
            --border-color: #3A3A3A;
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-color);
            padding-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
            margin-bottom: 20px;
            color: var(--text-color);
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--card-header);
            border-bottom: 1px solid var(--border-color);
        }
        
        .stock-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alias-item {
            background-color: var(--darker-bg);
            border-left: 4px solid var(--primary-color);
            margin-bottom: 8px;
            transition: all 0.2s;
        }
        
        .alias-item:hover {
            background-color: #3A3A3A;
            transform: translateX(5px);
        }
        
        .search-container {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .bg-success {
            background-color: var(--success-color) !important;
        }
        
        .table {
            color: var(--text-color);
        }
        
        .table td, .table th {
            border-color: var(--border-color);
        }
        
        .text-muted {
            color: var(--text-muted) !important;
        }
        
        .alert-info {
            background-color: rgba(52, 152, 219, 0.2);
            border-color: rgba(52, 152, 219, 0.3);
            color: var(--text-color);
        }
        
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            border-color: rgba(231, 76, 60, 0.3);
            color: var(--text-color);
        }
        
        .form-control, .input-group-text {
            background-color: var(--darker-bg);
            border-color: var(--border-color);
            color: var(--text-color);
        }
        
        .form-control:focus {
            background-color: var(--darker-bg);
            color: var(--text-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        footer {
            background-color: var(--darker-bg) !important;
            color: var(--text-muted);
        }
        
        /* Loading spinner */
        .loader-container {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin: 50px auto;
            max-width: 500px;
            text-align: center;
        }
        
        .loader {
            border: 5px solid rgba(52, 152, 219, 0.2);
            border-radius: 50%;
            border-top: 5px solid var(--primary-color);
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        .loader-text {
            text-align: center;
            max-width: 300px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Stock logo styling */
        .stock-logo {
            max-height: 60px;
            max-width: 60px;
            object-fit: contain;
            margin-right: 15px;
        }
        
        .company-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: var(--card-header);
            padding: 15px;
            border-radius: 5px;
        }
        
        .stock-info-card {
            height: 100%;
        }
        
        .text-success {
            color: var(--success-color) !important;
        }
        
        .text-danger {
            color: var(--danger-color) !important;
        }
        
        .company-details {
            margin-left: 15px;
        }
        
        .price-change {
            margin-top: 5px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">
            <i class="fas fa-chart-line me-2"></i>CheckMyStock - ALPHA v1.0.0
        </h1>
        
        <div class="search-container">
            <form id="stockForm" method="GET" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="symbol" class="form-control" placeholder="Enter stock symbol (e.g., AAPL, MSFT)" 
                                value="<?php echo isset($_GET['symbol']) ? htmlspecialchars($_GET['symbol']) : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </div>
            </form>
            
            <?php if (!isset($_GET['symbol'])) { ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Enter a stock symbol to get detailed information and similar stocks.
                </div>
            <?php } ?>
        </div>

        <div id="loadingSection" style="display: <?php echo isset($_GET['symbol']) ? 'none' : 'none'; ?>">
            <div class="loader-container">
                <div class="loader"></div>
                <div class="loader-text">
                    <h4>Loading stock data...</h4>
                    <p class="text-muted">Fetching the latest financial metrics and company information.</p>
                    <div id="loadingTips" class="mt-3"></div>
                </div>
            </div>
        </div>

        <div id="contentSection" style="display: block;">
            <?php
            if (isset($_GET['symbol'])) {
                $symbol = strtoupper(trim($_GET['symbol']));
                $fmpApiKey = 'TS7dAXGizXA4HhENFsDpWK3jpvZWuNM1'; // Financial Modeling Prep API key
                $alphaVantageApiKey = 'Z8027PQP429B5SMI'; // Alpha Vantage API key
                
                // Get stock profile information from FMP
                $profileUrl = "https://financialmodelingprep.com/api/v3/profile/$symbol?apikey=$fmpApiKey";
                $profileResponse = file_get_contents($profileUrl);
                $profileData = json_decode($profileResponse, true);
                
                // Get similar stocks (aliases) from FMP
                $symbolsUrl = "https://financialmodelingprep.com/api/v3/stock/similar/$symbol?apikey=$fmpApiKey";
                $symbolsResponse = file_get_contents($symbolsUrl);
                $similarStocks = json_decode($symbolsResponse, true);
                
                // Get data from Alpha Vantage for BVPS calculation
                $alphaVantageBalanceSheetUrl = "https://www.alphavantage.co/query?function=BALANCE_SHEET&symbol=$symbol&apikey=$alphaVantageApiKey";
                $alphaVantageBalanceSheetResponse = file_get_contents($alphaVantageBalanceSheetUrl);
                $alphaVantageBalanceSheetData = json_decode($alphaVantageBalanceSheetResponse, true);
                
                // Get income statement data from Alpha Vantage for ROIC
                $alphaVantageIncomeStatementUrl = "https://www.alphavantage.co/query?function=INCOME_STATEMENT&symbol=$symbol&apikey=$alphaVantageApiKey";
                $alphaVantageIncomeStatementResponse = file_get_contents($alphaVantageIncomeStatementUrl);
                $alphaVantageIncomeStatementData = json_decode($alphaVantageIncomeStatementResponse, true);
                
                // Get balance sheet data for Debt-to-Equity from FMP
                $balanceSheetUrl = "https://financialmodelingprep.com/api/v3/balance-sheet-statement/$symbol?limit=1&apikey=$fmpApiKey";
                $balanceSheetResponse = file_get_contents($balanceSheetUrl);
                $balanceSheetData = json_decode($balanceSheetResponse, true);
                
                // Get income statement data for ROIC from FMP
                $incomeStatementUrl = "https://financialmodelingprep.com/api/v3/income-statement/$symbol?limit=1&apikey=$fmpApiKey";
                $incomeStatementResponse = file_get_contents($incomeStatementUrl);
                $incomeStatementData = json_decode($incomeStatementResponse, true);
                
                // Calculate financial metrics
                $bvps = 0;
                $debtToEquity = 0;
                $roic = 0;
                $bvpsSource = 'N/A'; // To track which API provided the BVPS data
                $roicSource = 'N/A'; // To track which API provided the ROIC data
                $debtToEquitySource = 'N/A'; // To track which API provided the Debt-to-Equity data
                
                // Try to calculate BVPS from Alpha Vantage data first
                if (!empty($alphaVantageBalanceSheetData) && isset($alphaVantageBalanceSheetData['annualReports']) && 
                    is_array($alphaVantageBalanceSheetData['annualReports']) && count($alphaVantageBalanceSheetData['annualReports']) > 0) {
                    
                    $latestReport = $alphaVantageBalanceSheetData['annualReports'][0];
                    
                    // Calculate BVPS using Alpha Vantage data
                    if (isset($latestReport['totalShareholderEquity']) && isset($latestReport['commonStockSharesOutstanding']) && 
                        $latestReport['commonStockSharesOutstanding'] > 0) {
                        $bvps = $latestReport['totalShareholderEquity'] / $latestReport['commonStockSharesOutstanding'];
                        $bvpsSource = 'Alpha Vantage';
                    }
                }
                
                // If Alpha Vantage doesn't have the data, try FMP as a fallback
                if ($bvps == 0 && !empty($balanceSheetData) && is_array($balanceSheetData) && count($balanceSheetData) > 0) {
                    $balanceSheet = $balanceSheetData[0];
                    
                    // Calculate BVPS using FMP data
                    if (isset($balanceSheet['totalStockholdersEquity']) && isset($balanceSheet['commonStock']) && 
                        isset($balanceSheet['commonStockSharesOutstanding']) && $balanceSheet['commonStockSharesOutstanding'] > 0) {
                        $bvps = ($balanceSheet['totalStockholdersEquity'] - $balanceSheet['commonStock']) / $balanceSheet['commonStockSharesOutstanding'];
                        $bvpsSource = 'Financial Modeling Prep';
                    }
                }
                
                // Try to calculate Debt-to-Equity and ROIC using Alpha Vantage data
                if (!empty($alphaVantageBalanceSheetData) && isset($alphaVantageBalanceSheetData['annualReports']) && 
                    is_array($alphaVantageBalanceSheetData['annualReports']) && count($alphaVantageBalanceSheetData['annualReports']) > 0) {
                    
                    $balanceSheetReport = $alphaVantageBalanceSheetData['annualReports'][0];
                    
                    // Calculate Debt-to-Equity Ratio using Alpha Vantage data
                    if (isset($balanceSheetReport['totalLiabilities']) && isset($balanceSheetReport['totalShareholderEquity']) && 
                        floatval($balanceSheetReport['totalShareholderEquity']) > 0) {
                        $debtToEquity = floatval($balanceSheetReport['totalLiabilities']) / floatval($balanceSheetReport['totalShareholderEquity']);
                        $debtToEquitySource = 'Alpha Vantage';
                    }
                    
                    // ROIC calculation (if income statement data is available)
                    if (!empty($alphaVantageIncomeStatementData) && isset($alphaVantageIncomeStatementData['annualReports']) && 
                        is_array($alphaVantageIncomeStatementData['annualReports']) && count($alphaVantageIncomeStatementData['annualReports']) > 0) {
                        
                        $incomeStatementReport = $alphaVantageIncomeStatementData['annualReports'][0];
                        
                        // Extract components for ROIC calculation
                        $ebit = isset($incomeStatementReport['ebit']) ? floatval($incomeStatementReport['ebit']) : 0;
                        $incomeTaxExpense = isset($incomeStatementReport['incomeTaxExpense']) ? floatval($incomeStatementReport['incomeTaxExpense']) : 0;
                        $incomeBeforeTax = isset($incomeStatementReport['incomeBeforeTax']) ? floatval($incomeStatementReport['incomeBeforeTax']) : 0;
                        $totalEquity = isset($balanceSheetReport['totalShareholderEquity']) ? floatval($balanceSheetReport['totalShareholderEquity']) : 0;
                        $shortTermDebt = isset($balanceSheetReport['shortTermDebt']) ? floatval($balanceSheetReport['shortTermDebt']) : 0;
                        $longTermDebt = isset($balanceSheetReport['longTermDebt']) ? floatval($balanceSheetReport['longTermDebt']) : 0;
                        $cash = isset($balanceSheetReport['cashAndCashEquivalentsAtCarryingValue']) ? floatval($balanceSheetReport['cashAndCashEquivalentsAtCarryingValue']) : 0;
                        
                        // Calculate tax rate
                        $taxRate = ($incomeBeforeTax > 0) ? $incomeTaxExpense / $incomeBeforeTax : 0;
                        
                        // Calculate NOPAT
                        $nopat = $ebit * (1 - $taxRate);
                        
                        // Calculate Invested Capital
                        $totalDebt = $shortTermDebt + $longTermDebt;
                        $investedCapital = $totalEquity + $totalDebt - $cash;
                        
                        // Calculate ROIC
                        if ($investedCapital > 0) {
                            $roic = $nopat / $investedCapital;
                            $roicSource = 'Alpha Vantage';
                        }
                    }
                }
                
                // If ROIC couldn't be calculated from Alpha Vantage, try using FMP data as fallback
                if ($roic == 0 || $debtToEquity == 0) {
                    // Continue with other calculations using FMP data
                    if (!empty($balanceSheetData) && is_array($balanceSheetData) && count($balanceSheetData) > 0) {
                        $balanceSheet = $balanceSheetData[0];
                        
                        // Debt-to-Equity Ratio using FMP data if not already calculated
                        if ($debtToEquity == 0 && isset($balanceSheet['totalLiabilities']) && isset($balanceSheet['totalStockholdersEquity']) && 
                            $balanceSheet['totalStockholdersEquity'] > 0) {
                            $debtToEquity = $balanceSheet['totalLiabilities'] / $balanceSheet['totalStockholdersEquity'];
                            $debtToEquitySource = 'Financial Modeling Prep';
                        }
                        
                        // Calculate ROIC using FMP data if not already calculated
                        if ($roic == 0 && !empty($incomeStatementData) && is_array($incomeStatementData) && count($incomeStatementData) > 0) {
                            $incomeStatement = $incomeStatementData[0];
                            
                            // Calculate tax rate
                            $taxRate = 0;
                            if (isset($incomeStatement['incomeTaxExpense']) && isset($incomeStatement['incomeBeforeTax']) && 
                                $incomeStatement['incomeBeforeTax'] > 0) {
                                $taxRate = $incomeStatement['incomeTaxExpense'] / $incomeStatement['incomeBeforeTax'];
                            }
                            
                            // Calculate NOPAT (Net Operating Profit After Tax)
                            $nopat = 0;
                            if (isset($incomeStatement['ebit'])) {
                                $nopat = $incomeStatement['ebit'] * (1 - $taxRate);
                            }
                            
                            // Calculate Invested Capital
                            $investedCapital = 0;
                            if (isset($balanceSheet['totalDebt']) && isset($balanceSheet['totalStockholdersEquity']) && 
                                isset($balanceSheet['cashAndCashEquivalents'])) {
                                $investedCapital = $balanceSheet['totalDebt'] + $balanceSheet['totalStockholdersEquity'] - $balanceSheet['cashAndCashEquivalents'];
                            }
                            
                            // Calculate ROIC
                            if ($investedCapital > 0) {
                                $roic = $nopat / $investedCapital;
                                $roicSource = 'Financial Modeling Prep';
                            }
                        }
                    }
                }
                
                if (!empty($profileData)) {
                    $stock = $profileData[0];
            ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="company-header">
                                    <div class="d-flex align-items-center">
                                        <?php if (isset($stock['image']) && !empty($stock['image'])) { ?>
                                        <img src="<?php echo htmlspecialchars($stock['image']); ?>" alt="<?php echo htmlspecialchars($stock['companyName']); ?> logo" 
                                            class="stock-logo">
                                        <?php } ?>
                                        <div class="ms-3">
                                            <h2 class="mb-0"><?php echo htmlspecialchars($stock['companyName']); ?> (<?php echo htmlspecialchars($stock['symbol']); ?>)</h2>
                                            <h3 class="mb-0">$<?php echo number_format($stock['price'], 2); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <td><?php echo htmlspecialchars($stock['companyName']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stock Ticker</th>
                                                        <td><?php echo htmlspecialchars($stock['symbol']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Market Cap</th>
                                                        <td><?php echo isset($stock['mktCap']) ? '$' . number_format($stock['mktCap'], 0) : 'N/A'; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>52 Week Range</th>
                                                        <td><?php echo isset($stock['range']) ? htmlspecialchars($stock['range']) : 'N/A'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>$<?php echo number_format($stock['price'], 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dividend Yield</th>
                                                        <td><?php echo isset($stock['lastDiv']) ? htmlspecialchars($stock['lastDiv']) : 'N/A'; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <?php if (isset($stock['description']) && !empty($stock['description'])) { ?>
                                    <div class="mt-3">
                                        <h5>About <?php echo htmlspecialchars($stock['companyName']); ?></h5>
                                        <p><?php echo htmlspecialchars($stock['description']); ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Similar Stocks</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (!empty($similarStocks) && isset($similarStocks['similar'])) {
                                        $aliases = $similarStocks['similar'];
                                        if (count($aliases) > 0) {
                                            echo '<ul class="list-group">';
                                            foreach ($aliases as $alias) {
                                                echo '<li class="list-group-item alias-item">';
                                                echo '<a href="?symbol=' . htmlspecialchars($alias) . '" class="d-block p-2 text-decoration-none">';
                                                echo '<i class="fas fa-external-link-alt me-2"></i>' . htmlspecialchars($alias);
                                                echo '</a></li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo '<div class="alert alert-info">No similar stocks found.</div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-info">No similar stocks information available.</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- New Financial Ratios Section -->
                    <div class="card mt-4">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Financial Ratios</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Metric</th>
                                                <th>Value</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Book Value per Share (BVPS)</th>
                                                <td>
                                                    <?php 
                                                    if ($bvps > 0) {
                                                        echo '$' . number_format($bvps, 2);
                                                        echo ' <small class="text-muted">(' . $bvpsSource . ')</small>';
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                                <td><small class="text-muted">Net asset value per share of common stock</small></td>
                                            </tr>
                                            <tr>
                                                <th>Debt-to-Equity Ratio</th>
                                                <td>
                                                    <?php 
                                                    if ($debtToEquity > 0) {
                                                        echo number_format($debtToEquity, 2);
                                                        echo ' <small class="text-muted">(' . $debtToEquitySource . ')</small>';
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                                <td><small class="text-muted">Measures financial leverage and company risk</small></td>
                                            </tr>
                                            <tr>
                                                <th>Return on Invested Capital (ROIC)</th>
                                                <td>
                                                    <?php 
                                                    if ($roic > 0) {
                                                        echo number_format($roic * 100, 2) . '%';
                                                        echo ' <small class="text-muted">(' . $roicSource . ')</small>';
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                                <td><small class="text-muted">Profitability relative to capital invested</small></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>No data found for symbol: ' . htmlspecialchars($symbol) . '</div>';
                }
            }
            ?>
        </div>
    </div>
    
    <footer class="bg-light mt-5 py-3 text-center">
        <div class="container">
            <p class="text-muted mb-0">CheckMyStock &copy; <?php echo date('Y'); ?> | Data provided by Financial Modeling Prep</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stockForm = document.getElementById('stockForm');
            const loadingSection = document.getElementById('loadingSection');
            const contentSection = document.getElementById('contentSection');
            const loadingTips = document.getElementById('loadingTips');
            
            // Stock market tips to show while loading
            const tips = [
                "Did you know? The stock market has historically returned an average of 10% annually since 1926.",
                "Tip: Diversification is key to reducing investment risk.",
                "Fun fact: The New York Stock Exchange was founded in 1792 under a buttonwood tree on Wall Street.",
                "Reminder: Past performance is not indicative of future results.",
                "Tip: The P/E ratio (Price-to-Earnings) helps assess if a stock is overvalued or undervalued.",
                "Fact: 'Bull' and 'Bear' markets are named after how these animals attack - bulls thrust upward, while bears swipe downward.",
                "BVPS (Book Value Per Share) is a key metric for value investors.",
                "A low Debt-to-Equity ratio generally indicates a financially stable company.",
                "ROIC (Return on Invested Capital) shows how efficiently a company uses its capital to generate returns."
            ];
            
            // Function to display random stock market tips
            function showRandomTip() {
                const randomTip = tips[Math.floor(Math.random() * tips.length)];
                if (loadingTips) {
                    loadingTips.innerHTML = `<div class="alert alert-info"><i class="fas fa-lightbulb me-2"></i>${randomTip}</div>`;
                }
            }
            
            // If there's a form submission
            if (stockForm) {
                stockForm.addEventListener('submit', function(event) {
                    // Store the symbol for the next page
                    const symbol = document.querySelector('input[name="symbol"]').value;
                    if (symbol) {
                        localStorage.setItem('pendingSymbol', symbol);
                        
                        // Don't prevent default - we want the form to actually submit
                        // This will cause a page reload with the new query parameter
                    }
                });
            }
            
            // Check if we have a pending search (after page loads)
            const pendingSymbol = localStorage.getItem('pendingSymbol');
            if (pendingSymbol) {
                // Clear the pending symbol
                localStorage.removeItem('pendingSymbol');
                
                // Hide content and show loading
                if (contentSection) contentSection.style.display = 'none';
                if (loadingSection) loadingSection.style.display = 'block';
                
                // Show random tips and start cycling them
                showRandomTip();
                const tipInterval = setInterval(showRandomTip, 3000);
                
                // After a few seconds, reveal the content
                setTimeout(function() {
                    if (loadingSection) loadingSection.style.display = 'none';
                    if (contentSection) contentSection.style.display = 'block';
                    clearInterval(tipInterval);
                }, 2000);
            }
        });
    </script>
</body>
</html>
