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
            border-top: 1px solid var(--border-color);
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .footer-credits {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-brand {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .footer-api-logos {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .footer-api-logo {
            height: 25px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .footer-api-logo:hover {
            opacity: 1;
        }
        
        @media (max-width: 767px) {
            .footer-credits {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-api-logos {
                margin-top: 15px;
                justify-content: center;
            }
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
        
        .ratio-card {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            transition: all 0.3s;
            background-color: var(--darker-bg);
        }
        
        .ratio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        
        .ratio-value {
            margin: 15px 0;
        }
        
        .share-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border: none;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .share-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }
        
        .share-buttons {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }
        
        .share-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.3s;
            color: white;
        }
        
        .share-icon:hover {
            transform: scale(1.1);
        }
        
        .share-whatsapp {
            background-color: #25D366;
        }
        
        .share-facebook {
            background-color: #3b5998;
        }
        
        .share-email {
            background-color: #D44638;
        }
        
        .share-instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #F77737, #FCAF45, #FFDC80);
        }
        
        /* News card styling */
        .news-card {
            transition: all 0.3s ease;
            border-left: 4px solid var(--success-color);
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .news-link {
            color: var(--text-color);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .news-link:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .card-footer {
            border-top: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">
            <i class="fas fa-chart-line me-2"></i>CheckMyStock - ALPHA v1.0.9
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
                    
                    // Check if we have shares outstanding in the stock profile
                    $sharesOutstanding = 0;
                    if (!empty($profileData) && is_array($profileData) && count($profileData) > 0) {
                        if (isset($profileData[0]['mktCap']) && isset($profileData[0]['price']) && $profileData[0]['price'] > 0) {
                            // Calculate shares outstanding from market cap and price
                            $sharesOutstanding = $profileData[0]['mktCap'] / $profileData[0]['price'];
                        } else if (isset($profileData[0]['outstandingShares'])) {
                            $sharesOutstanding = $profileData[0]['outstandingShares'];
                        }
                    }
                    
                    // Calculate BVPS using FMP data and profile data for shares
                    if (isset($balanceSheet['totalStockholdersEquity']) && $sharesOutstanding > 0) {
                        // Calculate with or without common stock depending on availability
                        if (isset($balanceSheet['commonStock'])) {
                            $bvps = ($balanceSheet['totalStockholdersEquity'] - $balanceSheet['commonStock']) / $sharesOutstanding;
                        } else {
                            $bvps = $balanceSheet['totalStockholdersEquity'] / $sharesOutstanding;
                        }
                        $bvpsSource = 'Financial Modeling Prep';
                    } else if (isset($balanceSheet['totalStockholdersEquity']) && 
                              isset($balanceSheet['commonStockSharesOutstanding']) && 
                              $balanceSheet['commonStockSharesOutstanding'] > 0) {
                        // Try original method as fallback
                        $bvps = $balanceSheet['totalStockholdersEquity'] / $balanceSheet['commonStockSharesOutstanding'];
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
                            } else if (isset($incomeStatement['netIncome'])) {
                                // If EBIT is not available, use Net Income as a proxy
                                $nopat = $incomeStatement['netIncome'];
                            }
                            
                            // Calculate Invested Capital
                            $investedCapital = 0;
                            if (isset($balanceSheet['totalDebt']) && isset($balanceSheet['totalStockholdersEquity']) && 
                                isset($balanceSheet['cashAndCashEquivalents'])) {
                                $investedCapital = $balanceSheet['totalDebt'] + $balanceSheet['totalStockholdersEquity'] - $balanceSheet['cashAndCashEquivalents'];
                            }
                            
                            // Calculate ROIC
                            if ($investedCapital > 0 && $nopat != 0) {
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
                        <div class="col-12">
                            <!-- Company header with logo on the left -->
                            <div class="company-header d-flex align-items-center">
                                <?php if (isset($stock['image']) && !empty($stock['image'])) { ?>
                                    <img src="<?php echo htmlspecialchars($stock['image']); ?>" alt="<?php echo htmlspecialchars($stock['companyName']); ?> logo" class="stock-logo">
                                <?php } else { ?>
                                    <div class="stock-logo d-flex align-items-center justify-content-center bg-primary rounded">
                                        <span class="display-6 text-white"><?php echo substr($stock['symbol'], 0, 2); ?></span>
                                    </div>
                                <?php } ?>
                                <div class="ms-3">
                                    <h2 class="mb-0"><?php echo htmlspecialchars($stock['companyName']); ?> (<?php echo htmlspecialchars($stock['symbol']); ?>)</h2>
                                    <h3 class="text-<?php echo isset($stock['changes']) && $stock['changes'] >= 0 ? 'success' : 'danger'; ?>">
                                        $<?php echo number_format($stock['price'], 2); ?>
                                        <small class="ms-2 <?php echo isset($stock['changes']) && $stock['changes'] >= 0 ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo isset($stock['changes']) ? ($stock['changes'] >= 0 ? '+' : '') . number_format($stock['changes'], 2) : '0.00'; ?> 
                                            (<?php echo isset($stock['changesPercentage']) ? number_format($stock['changesPercentage'], 2) : '0.00'; ?>%)
                                        </small>
                                    </h3>
                                </div>
                                
                                <?php 
                                // Share buttons - prepare share data
                                $shareTitle = $stock['companyName'] . ' (' . $stock['symbol'] . ')';
                                $sharePrice = '$' . number_format($stock['price'], 2);
                                $shareChange = (isset($stock['changes']) && $stock['changes'] >= 0 ? '+' : '') . number_format(isset($stock['changes']) ? $stock['changes'] : 0, 2) . ' (' . number_format(isset($stock['changesPercentage']) ? $stock['changesPercentage'] : 0, 2) . '%)';
                                
                                // Build financial ratios part if available
                                $shareRatios = "";
                                if ($bvpsSource !== 'N/A') {
                                    $shareRatios .= "BVPS: $" . number_format($bvps, 2) . " | ";
                                }
                                if ($debtToEquitySource !== 'N/A') {
                                    $shareRatios .= "D/E: " . number_format($debtToEquity, 2) . " | ";
                                }
                                if ($roicSource !== 'N/A') {
                                    $shareRatios .= "ROIC: " . number_format($roic * 100, 2) . "% | ";
                                }
                                $shareRatios = rtrim($shareRatios, " | ");
                                
                                // Build the share text
                                $shareText = "Check out " . $shareTitle . " trading at " . $sharePrice . " " . $shareChange;
                                if (!empty($shareRatios)) {
                                    $shareText .= "\n" . $shareRatios;
                                }
                                $shareText .= "\n\nAnalyzed with CheckMyStock - The simple stock analyzer!";
                                
                                // Current URL
                                $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                
                                // Share URLs
                                $whatsappUrl = "https://wa.me/?text=" . urlencode($shareText . "\n\n" . $currentUrl);
                                $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($currentUrl) . "&quote=" . urlencode($shareText);
                                $emailSubject = "Check out this stock: " . $shareTitle;
                                $emailUrl = "mailto:?subject=" . urlencode($emailSubject) . "&body=" . urlencode($shareText . "\n\n" . $currentUrl);
                                ?>
                                <div class="share-buttons">
                                    <a href="<?php echo $whatsappUrl; ?>" target="_blank" class="share-icon share-whatsapp" title="Share via WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="<?php echo $facebookUrl; ?>" target="_blank" class="share-icon share-facebook" title="Share via Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="<?php echo $emailUrl; ?>" class="share-icon share-email" title="Share via Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" onclick="copyToClipboard('<?php echo addslashes($shareText . "\n\n" . $currentUrl); ?>')" class="share-icon share-instagram" title="Copy for Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Financial Ratios Section - Now at the top -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h4 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Financial Ratios</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Book Value per Share (BVPS)</h5>
                                                <div class="ratio-value">
                                                    <?php 
                                                    // Simply display the value, regardless of whether it's zero
                                                    if ($bvpsSource !== 'N/A') {
                                                        echo '<span class="h3">$' . number_format($bvps, 2) . '</span>';
                                                        echo '<div class="text-muted small">(' . $bvpsSource . ')</div>';
                                                    } else {
                                                        echo '<span class="h3">N/A</span>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="text-muted small mt-2">Net asset value per share of common stock</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Debt-to-Equity Ratio</h5>
                                                <div class="ratio-value">
                                                    <?php 
                                                    // Simply display the value, regardless of whether it's zero  
                                                    if ($debtToEquitySource !== 'N/A') {
                                                        echo '<span class="h3">' . number_format($debtToEquity, 2) . '</span>';
                                                        echo '<div class="text-muted small">(' . $debtToEquitySource . ')</div>';
                                                    } else {
                                                        echo '<span class="h3">N/A</span>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="text-muted small mt-2">Measures financial leverage and company risk</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Return on Invested Capital</h5>
                                                <div class="ratio-value">
                                                    <?php 
                                                    // Simply display the value, regardless of whether it's zero
                                                    if ($roicSource !== 'N/A') {
                                                        // Use different text color for negative ROIC
                                                        $roicClass = $roic < 0 ? 'text-danger' : '';
                                                        echo '<span class="h3 ' . $roicClass . '">' . number_format($roic * 100, 2) . '%</span>';
                                                        echo '<div class="text-muted small">(' . $roicSource . ')</div>';
                                                    } else {
                                                        echo '<span class="h3">N/A</span>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="text-muted small mt-2">Profitability relative to capital invested</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Company Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Company Name</h5>
                                                <div class="ratio-value">
                                                    <span class="h4"><?php echo htmlspecialchars($stock['companyName']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Stock Ticker</h5>
                                                <div class="ratio-value">
                                                    <span class="h4"><?php echo htmlspecialchars($stock['symbol']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Market Cap</h5>
                                                <div class="ratio-value">
                                                    <span class="h4"><?php echo isset($stock['mktCap']) ? '$' . number_format($stock['mktCap'], 0) : 'N/A'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>52 Week Range</h5>
                                                <div class="ratio-value">
                                                    <span class="h5"><?php echo isset($stock['range']) ? htmlspecialchars($stock['range']) : 'N/A'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Price</h5>
                                                <div class="ratio-value">
                                                    <span class="h4">$<?php echo number_format($stock['price'], 2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ratio-card p-3 text-center">
                                                <h5>Dividend Yield</h5>
                                                <div class="ratio-value">
                                                    <span class="h4"><?php echo isset($stock['lastDiv']) ? htmlspecialchars($stock['lastDiv']) : 'N/A'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if (isset($stock['description']) && !empty($stock['description'])) { ?>
                                    <div class="mt-4">
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
                                    <h4 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Top 10 Similar Stocks</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Try to get similar stocks from FMP first
                                    $topSimilarStocks = [];
                                    if (!empty($similarStocks) && isset($similarStocks['similar'])) {
                                        $topSimilarStocks = array_slice($similarStocks['similar'], 0, 10);
                                    }
                                    
                                    // If we don't have enough stocks from FMP, try Alpha Vantage
                                    if (count($topSimilarStocks) < 10) {
                                        // Get top stocks from sector if available
                                        if (isset($stock['sector']) && !empty($stock['sector'])) {
                                            $sectorStocksUrl = "https://financialmodelingprep.com/api/v3/stock-screener?sector=" . urlencode($stock['sector']) . "&limit=10&apikey=" . $fmpApiKey;
                                            $sectorStocksResponse = @file_get_contents($sectorStocksUrl);
                                            if ($sectorStocksResponse !== false) {
                                                $sectorStocks = json_decode($sectorStocksResponse, true);
                                                if (!empty($sectorStocks) && is_array($sectorStocks)) {
                                                    foreach ($sectorStocks as $sectorStock) {
                                                        if (isset($sectorStock['symbol']) && $sectorStock['symbol'] != $symbol && !in_array($sectorStock['symbol'], $topSimilarStocks)) {
                                                            $topSimilarStocks[] = $sectorStock['symbol'];
                                                            if (count($topSimilarStocks) >= 10) {
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    
                                    // Get company names for the top similar stocks
                                    $stocksWithNames = [];
                                    if (count($topSimilarStocks) > 0) {
                                        // Create batch query string
                                        $batchSymbols = implode(',', $topSimilarStocks);
                                        $profileBatchUrl = "https://financialmodelingprep.com/api/v3/profile/$batchSymbols?apikey=$fmpApiKey";
                                        $profileBatchResponse = @file_get_contents($profileBatchUrl);
                                        
                                        if ($profileBatchResponse !== false) {
                                            $profilesData = json_decode($profileBatchResponse, true);
                                            
                                            // Create mapping of symbol to company name
                                            $symbolToName = [];
                                            if (!empty($profilesData) && is_array($profilesData)) {
                                                foreach ($profilesData as $profile) {
                                                    if (isset($profile['symbol']) && isset($profile['companyName'])) {
                                                        $symbolToName[$profile['symbol']] = $profile['companyName'];
                                                    }
                                                }
                                            }
                                            
                                            // Now create the final array with both symbol and name
                                            foreach ($topSimilarStocks as $stockSymbol) {
                                                $companyName = isset($symbolToName[$stockSymbol]) ? $symbolToName[$stockSymbol] : 'Unknown';
                                                $stocksWithNames[] = [
                                                    'symbol' => $stockSymbol,
                                                    'name' => $companyName
                                                ];
                                            }
                                        } else {
                                            // If batch request fails, just use symbols
                                            foreach ($topSimilarStocks as $stockSymbol) {
                                                $stocksWithNames[] = [
                                                    'symbol' => $stockSymbol,
                                                    'name' => 'Unknown'
                                                ];
                                            }
                                        }
                                    }
                                    
                                    // Display the top similar stocks
                                    if (count($stocksWithNames) > 0) {
                                        echo '<ul class="list-group">';
                                        foreach ($stocksWithNames as $stock) {
                                            echo '<li class="list-group-item alias-item">';
                                            echo '<a href="?symbol=' . htmlspecialchars($stock['symbol']) . '" class="d-block p-2 text-decoration-none">';
                                            echo '<i class="fas fa-external-link-alt me-2"></i>' . htmlspecialchars($stock['symbol']);
                                            echo ' <small class="text-muted">(' . htmlspecialchars($stock['name']) . ')</small>';
                                            echo '</a></li>';
                                        }
                                        echo '</ul>';
                                    } else {
                                        echo '<div class="alert alert-info">No similar stocks found.</div>';
                                    }
                                    ?>
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
        
        <?php if (!isset($_GET['symbol'])) { ?>
            <!-- Homepage content - show when no specific stock is requested -->
            <!-- 1. Fetch top 10 most active stocks -->
            <?php
            // Define the API key if not already defined
            if (!isset($fmpApiKey)) {
                $fmpApiKey = "TS7dAXGizXA4HhENFsDpWK3jpvZWuNM1";
            }
            
            $mostActiveUrl = "https://financialmodelingprep.com/api/v3/stock_market/actives?apikey=" . $fmpApiKey;
            $mostActiveResponse = @file_get_contents($mostActiveUrl);
            $mostActiveStocks = [];
            
            if ($mostActiveResponse !== false) {
                $mostActiveStocks = json_decode($mostActiveResponse, true);
            }
            
            // If the main API call fails, try the gainers endpoint as fallback
            if (empty($mostActiveStocks)) {
                $gainersUrl = "https://financialmodelingprep.com/api/v3/stock_market/gainers?apikey=" . $fmpApiKey;
                $gainersResponse = @file_get_contents($gainersUrl);
                
                if ($gainersResponse !== false) {
                    $mostActiveStocks = json_decode($gainersResponse, true);
                }
            }
            
            // If that still fails, try a different endpoint as a final fallback
            if (empty($mostActiveStocks)) {
                $stockListUrl = "https://financialmodelingprep.com/api/v3/stock/list?apikey=" . $fmpApiKey;
                $stockListResponse = @file_get_contents($stockListUrl);
                
                if ($stockListResponse !== false) {
                    $stockList = json_decode($stockListResponse, true);
                    
                    // Take the first 10 stocks from the list
                    $mostActiveStocks = array_slice($stockList, 0, 10);
                    
                    // Add missing fields if necessary
                    foreach ($mostActiveStocks as &$stock) {
                        if (!isset($stock['change'])) $stock['change'] = 0;
                        if (!isset($stock['changesPercentage'])) $stock['changesPercentage'] = 0;
                        if (!isset($stock['name'])) $stock['name'] = $stock['symbol'];
                    }
                }
            }
            
            // 2. Fetch market news from RSS feed
            $marketNewsItems = [];
            $rssFeeds = [
                'Yahoo Finance' => 'https://finance.yahoo.com/news/rssindex',
                'Investing.com' => 'https://www.investing.com/rss/news.rss',
                'CNBC' => 'https://www.cnbc.com/id/10001147/device/rss/rss.html'
            ];
            
            // Try each feed until we get some news
            foreach ($rssFeeds as $source => $feedUrl) {
                $rss = @simplexml_load_file($feedUrl);
                if ($rss) {
                    $count = 0;
                    foreach ($rss->channel->item as $item) {
                        if ($count >= 5) break; // Get 5 news items
                        
                        $pubDate = isset($item->pubDate) ? date('M d, Y', strtotime($item->pubDate)) : '';
                        $description = (string)$item->description;
                        
                        // Clean up the description text
                        $description = strip_tags($description);
                        // Remove any ellipsis that might be in the original text
                        $description = str_replace('...', '', $description);
                        // Truncate and add our own ellipsis
                        if (strlen($description) > 150) {
                            $description = substr($description, 0, 150) . '…';
                        }
                        
                        $marketNewsItems[] = [
                            'title' => (string)$item->title,
                            'link' => (string)$item->link,
                            'description' => $description,
                            'pubDate' => $pubDate,
                            'source' => $source
                        ];
                        $count++;
                    }
                    
                    if (count($marketNewsItems) > 0) {
                        break; // If we got news, we can stop trying feeds
                    }
                }
            }
            
            // If no RSS feeds worked, use a fallback message
            if (empty($marketNewsItems)) {
                $marketNewsItems[] = [
                    'title' => 'Market data currently unavailable',
                    'description' => 'Please check back later for the latest market news and updates.',
                    'pubDate' => date('M d, Y'),
                    'source' => 'System'
                ];
            }
            
            // Display homepage with top stocks and news
            ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-fire me-2"></i>Today's Most Active Stocks</h4>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($mostActiveStocks)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Symbol</th>
                                                <th>Company</th>
                                                <th>Price</th>
                                                <th>Change</th>
                                                <th>% Change</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                            foreach ($mostActiveStocks as $stock) {
                                                if ($count >= 10) break; // Only show top 10
                                                
                                                $changeClass = isset($stock['change']) && $stock['change'] >= 0 ? 'text-success' : 'text-danger';
                                                $changeSign = isset($stock['change']) && $stock['change'] >= 0 ? '+' : '';
                                                $changePercentage = isset($stock['changesPercentage']) ? $stock['changesPercentage'] : 0;
                                            ?>
                                                <tr>
                                                    <td><strong><?php echo htmlspecialchars($stock['symbol']); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($stock['name']); ?></td>
                                                    <td>$<?php echo number_format($stock['price'], 2); ?></td>
                                                    <td class="<?php echo $changeClass; ?>"><?php echo $changeSign . number_format($stock['change'], 2); ?></td>
                                                    <td class="<?php echo $changeClass; ?>"><?php echo $changeSign . number_format($changePercentage, 2); ?>%</td>
                                                    <td>
                                                        <a href="?symbol=<?php echo $stock['symbol']; ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-chart-line me-1"></i>Analyze
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php 
                                                $count++;
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-info m-3">
                                    <i class="fas fa-info-circle me-2"></i>Unable to load most active stocks. Please try again later.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0"><i class="fas fa-newspaper me-2"></i>Latest Market News</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($marketNewsItems as $item) { ?>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 news-card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php if (isset($item['link'])) { ?>
                                                    <a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank" class="news-link">
                                                        <?php echo htmlspecialchars($item['title']); ?>
                                                    </a>
                                                <?php } else { ?>
                                                    <?php echo htmlspecialchars($item['title']); ?>
                                                <?php } ?>
                                            </h5>
                                            <p class="card-text text-muted"><?php echo $item['description']; ?></p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-transparent">
                                            <small class="text-muted"><i class="fas fa-newspaper me-1"></i><?php echo $item['source']; ?></small>
                                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i><?php echo $item['pubDate']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-credits">
                <div>
                    <div class="footer-brand">
                        <i class="fas fa-chart-line me-2"></i>CheckMyStock
                    </div>
                    <p class="text-muted mb-0">
                        &copy; <?php echo date('Y'); ?> | Developed by Ahimsa GMS
                    </p>
                </div>
                <div>
                    <p class="text-muted mb-2">Data provided by:</p>
                    <div class="footer-api-logos">
                        <a href="https://financialmodelingprep.com/" target="_blank" title="Financial Modeling Prep">
                            <span class="text-muted">Financial Modeling Prep</span>
                        </a>
                        <span class="text-muted mx-2">|</span>
                        <a href="https://www.alphavantage.co/" target="_blank" title="Alpha Vantage">
                            <span class="text-muted">Alpha Vantage</span>
                        </a>
                    </div>
                </div>
            </div>
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
                    loadingTips.innerHTML = `<div class="alert alert-info mb-0"><i class="fas fa-lightbulb me-2"></i>${randomTip}</div>`;
                }
            }
            
            // Function to copy text to clipboard for Instagram sharing
            window.copyToClipboard = function(text) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Stock info copied! You can now paste it in Instagram.');
                }, function() {
                    // Fallback for browsers that don't support clipboard API
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    alert('Stock info copied! You can now paste it in Instagram.');
                });
            };
            
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
                }, 5500);
            }
        });
    </script>
</body>
</html>
