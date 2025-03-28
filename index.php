<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckMyStock - Stock Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .stock-header {
            background-color: #3498db;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alias-item {
            border-left: 4px solid #3498db;
            margin-bottom: 8px;
            transition: all 0.2s;
        }
        .alias-item:hover {
            background-color: #f1f8ff;
            transform: translateX(5px);
        }
        .search-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">
            <i class="fas fa-chart-line me-2"></i>CheckMyStock
        </h1>
        
        <div class="search-container">
            <form method="GET" class="mb-4">
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

        <?php
        if (isset($_GET['symbol'])) {
            $symbol = strtoupper(trim($_GET['symbol']));
            $apiKey = 'TS7dAXGizXA4HhENFsDpWK3jpvZWuNM1'; // replace with your actual API key
            
            // Get stock profile information
            $profileUrl = "https://financialmodelingprep.com/api/v3/profile/$symbol?apikey=$apiKey";
            $profileResponse = file_get_contents($profileUrl);
            $profileData = json_decode($profileResponse, true);
            
            // Get similar stocks (aliases)
            $symbolsUrl = "https://financialmodelingprep.com/api/v3/stock/similar/$symbol?apikey=$apiKey";
            $symbolsResponse = file_get_contents($symbolsUrl);
            $similarStocks = json_decode($symbolsResponse, true);
            
            if (!empty($profileData)) {
                $stock = $profileData[0];
        ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="stock-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="mb-0"><?php echo htmlspecialchars($stock['companyName']); ?> (<?php echo htmlspecialchars($stock['symbol']); ?>)</h2>
                                    <h3 class="mb-0">$<?php echo number_format($stock['price'], 2); ?></h3>
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
                        
                        <?php if (isset($stock['image']) && !empty($stock['image'])) { ?>
                        <div class="card mt-3">
                            <div class="card-body text-center">
                                <img src="<?php echo htmlspecialchars($stock['image']); ?>" alt="<?php echo htmlspecialchars($stock['companyName']); ?> logo" 
                                    class="img-fluid" style="max-height: 100px;">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
        <?php
            } else {
                echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>No data found for symbol: ' . htmlspecialchars($symbol) . '</div>';
            }
        }
        ?>
    </div>
    
    <footer class="bg-light mt-5 py-3 text-center">
        <div class="container">
            <p class="text-muted mb-0">CheckMyStock &copy; <?php echo date('Y'); ?> | Data provided by Financial Modeling Prep</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
