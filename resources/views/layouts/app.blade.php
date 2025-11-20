<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP</title>
    {{-- ADDED: Link to Font Awesome for dashboard icons (e.g., fas fa-paw) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    {{-- MOVED: The Unified Dashboard CSS from the body to the head to ensure global styling --}}
    <style>
/*========= General Page Layout ================== */
* {
    box-sizing: border-box;
}

html, body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
    height: 100%;
}

/* ================== Main Container ================== */
.page-container {
    max-width: 1400px;
    margin: 30px auto;
    padding: 20px;
    min-height: calc(100vh - 120px);
}

/* ================== Top Navigation Bar ================== */
.top-nav {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem 2rem;
}

.top-nav nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-nav .left-logo {
    max-height: 50px;
}

.top-nav nav ul {
    list-style: none;
    display: flex;
    gap: 2rem;
    margin: 0;
    padding: 0;
}

.top-nav nav ul li a {
    text-decoration: none;
    color: #6588e8;
    font-weight: 600;
    transition: color 0.3s;
}

.top-nav nav ul li a:hover {
    color: #4a6fc4;
}

/* ================== Main Content Area ================== */
.main-content {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin: 20px 0;
}

/* ================== Page Headers ================== */
.page-header {
    background: linear-gradient(135deg, #6588e8, #4a6fc4);
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 600;
}

.page-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
}

/* ================== Dashboard Grid & Cards ================== */
.dashboard-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

.welcome-section {
    background: linear-gradient(135deg, #6588e8, #4a6fc4);
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.welcome-section h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 600;
}

.welcome-section p {
    margin: 10px 0 0 0;
    font-size: 16px;
    opacity: 0.9;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.dashboard-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e0e0e0;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.dashboard-card h3 {
    color: #6588e8;
    margin-bottom: 15px;
    font-size: 20px;
}

.dashboard-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ================== Registration/Online Form Section ================== */
.registration-section {
    background: white;
    border-radius: 10px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.registration-section h2 {
    color: #6588e8;
    margin-bottom: 15px;
    font-size: 24px;
}

.registration-section p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ================== Data Tables ================== */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
}

.data-table th,
.data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.data-table th {
    background-color: #6588e8;
    color: white;
    text-transform: uppercase;
    font-size: 14px;
}

.data-table tr:hover {
    background-color: #f5f5f5;
}

/* ================== Buttons ================== */
.btn-dashboard {
    background-color: #f1c40f;
    color: black;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-dashboard:hover {
    background-color: #e2b607;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-logout {
    background-color: #e74c3c;
    color: white;
}

.btn-logout:hover {
    background-color: #c0392b;
}

.btn-primary {
    background-color: #6588e8;
    color: white;
}

.btn-primary:hover {
    background-color: #4a6fc4;
}

.btn-yellow {
    background-color: #f1c40f;
    color: black;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-blue {
    background-color: #6588e8;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s;
}

.add-btn {
    background-color: #2ecc71;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

.add-btn:hover {
    background-color: #27ae60;
}

.btn-submit {
    background-color: #2ecc71;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #27ae60;
}

/* ================== Action Buttons ================== */
.action-buttons a {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    font-weight: bold;
    margin-right: 5px;
    display: inline-block;
    transition: all 0.3s ease;
}

.edit-btn {
    background-color: #f1c40f;
    color: black;
}

.edit-btn:hover {
    background-color: #e2b607;
}

.delete-btn {
    background-color: #e74c3c;
}

.delete-btn:hover {
    background-color: #c0392b;
}

/* ================== Forms ================== */
.form-container {
    max-width: 700px;
    margin: 50px auto;
    padding: 30px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-container h1 {
    text-align: center;
    color: #6588e8;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #6588e8;
}

.back-link {
    display: inline-block;
    margin-bottom: 20px;
    color: #6588e8;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.back-link:hover {
    text-decoration: underline;
    color: #4a6fc4;
}

/* ================== Alerts ================== */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error,
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* ================== Information Box ================== */
.info-box {
    background: #e8f4fd;
    border-left: 4px solid #6588e8;
    padding: 20px;
    margin: 20px 0;
    border-radius: 0 8px 8px 0;
}

.info-box h3 {
    color: #6588e8;
    margin-top: 0;
}

/* ================== Video/Media Section ================== */
.content-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
    margin: 20px auto;
    max-width: 1100px;
    margin-bottom: 50px;
}

.content-wrapper-home {
    max-width: 1400px;
}

.left-section {
    flex: 1;
    min-width: 280px;
    text-align: center;
}

.left-section p {
    margin: 15px 0;
    line-height: 1.7;
    font-size: 16px;
    text-align: left;
    color: #555;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    max-width: 100%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.right-section {
    flex: 1.5;
    min-width: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ================== Footer ================== */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: auto;
    width: 100%;
}

footer p {
    margin: 0;
    font-size: 14px;
}

/* ================== Shortcut Section ================== */
.shortcut {
    background-color: #f4f4f4;
    padding: 10px 0;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.shortcut a {
    margin: 0 15px;
    text-decoration: none;
    color: #555;
    font-weight: bold;
    font-size: 14px;
    transition: color 0.3s;
}

.shortcut a:hover {
    color: #6588e8;
}

/* ================== Responsive Design ================== */
@media (max-width: 768px) {
    .top-nav {
        padding: 1rem;
    }
    
    .top-nav nav {
        flex-direction: column;
        gap: 15px;
    }
    
    .top-nav nav ul {
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }
    
    .page-container,
    .dashboard-container {
        padding: 15px;
        margin: 15px auto;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .main-content {
        padding: 20px;
        margin: 15px 0;
    }
    
    .page-header {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .page-header h1 {
        font-size: 24px;
    }

    .content-wrapper {
        flex-direction: column;
    }

    .left-section,
    .right-section {
        max-width: 100%;
    }

    .form-container {
        padding: 20px;
        margin: 20px auto;
    }
}

@media (max-width: 480px) {
    .btn-dashboard,
    .btn-yellow,
    .btn-blue,
    .add-btn {
        padding: 10px 20px;
        font-size: 13px;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .media-section {
        padding: 20px;
    }

    .data-table th,
    .data-table td {
        padding: 8px 10px;
        font-size: 12px;
    }
}
    </style>
</head>
<body>
    @yield('content') 
</body>
</html>