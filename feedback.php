<?php
include 'Connection.php';
include 'counter_logic.php';
include 'header.php';

if (!isset($con) && isset($conn)) {
    $con = $conn;
}

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$message = "";
$status = "";
if (isset($_POST['submit'])) {
    if (
        !empty($_POST['email']) && !empty($_POST['name']) &&
        !empty($_POST['address']) && !empty($_POST['resource']) &&
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        preg_match('/^[a-zA-Z0-9_\s]+$/', $_POST['name'])
    ) {
        $email        = $_POST['email'];
        $name         = $_POST['name'];
        $education    = (int)$_POST['Education'];
        $address      = $_POST['address'];
        $usedatabase  = (int)$_POST['usedatabase'];
        $content      = (int)$_POST['Content'];
        $resource     = $_POST['resource'];
        $howsatisfied = (int)$_POST['Howsatisfied'];
        $databaseuse  = (int)$_POST['databaseuse'];
        $improvement  = $_POST['improvement'];
        $addimprove   = $_POST['addimprove'];

        $stmt = $con->prepare("INSERT INTO feedback (uname, email, education, university, usedatabase, content, useresource, performance, oftenuse, features, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssisiiiisss", $name, $email, $education, $address, $usedatabase, $content, $resource, $howsatisfied, $databaseuse, $improvement, $addimprove);
            if ($stmt->execute()) {
                $message = "Feedback recorded successfully. Thank you!";
                $status = "success";
            } else {
                $message = "Database Error: " . addslashes($stmt->error);
                $status = "error";
            }
            $stmt->close();
        } else {
            $message = "Preparation Error: " . addslashes($con->error);
            $status = "error";
        }
        $con->close();
    } else {
        $message = "Please correct form errors before submitting.";
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feedback Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --text-main: #1F2937;
            --text-muted: #4B5563;
            --border: #E5E7EB;
            --error: #EF4444;
            --success: #10B981;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        .feedback-wrapper {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            padding: 40px;
            border: 1px solid var(--border);
        }

        .form-header h2 {
            margin: 0 0 8px 0;
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .form-header p {
            color: var(--text-muted);
            margin: 0 0 32px 0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        .form-group label.question-label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 15px;
            color: #374151;
        }

        .required-star {
            color: var(--error);
            margin-left: 4px;
        }

        /* Input Controls styling */
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 15px;
            color: var(--text-main);
            box-sizing: border-box;
            background-color: #FCFDFE;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* Validation UI helpers */
        .input-error {
            border-color: var(--error) !important;
        }

        .input-success {
            border-color: var(--success) !important;
        }

        .validation-hint {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .validation-hint.err {
            color: var(--error);
            display: block;
        }

        /* Custom Interactive Selection Cards for Education options */
        .grid-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
        }

        .card-option {
            position: relative;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            background: #fff;
            transition: all 0.2s ease;
            user-select: none;
        }

        .card-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .card-option:hover {
            border-color: #9CA3AF;
            background: #FAFAFA;
        }

        .card-option.selected {
            border-color: var(--primary);
            background: #EEF2FF;
            color: var(--primary);
            box-shadow: 0 0 0 1px var(--primary);
        }

        /* Linear Matrix Scale Container (1-5 scales) */
        .scale-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F9FAFB;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .scale-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            width: 80px;
        }

        .scale-label.right {
            text-align: right;
        }

        .scale-options {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-grow: 1;
        }

        .scale-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
        }

        .scale-item input[type="radio"] {
            margin-bottom: 6px;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .scale-item label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* Form Footer Layout Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid var(--border);
            padding-top: 24px;
            margin-top: 40px;
        }

        button[type="submit"],
        button[type="reset"] {
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            padding: 12px 26px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        button[type="submit"] {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        button[type="reset"] {
            background-color: #fff;
            color: #374151;
            border: 1px solid var(--border);
        }

        button[type="reset"]:hover {
            background-color: #F9FAFB;
            border-color: #D1D5DB;
        }

        /* Modern Toast Notification banner */
        .toast {
            position: fixed;
            top: 24px;
            right: 24px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.success {
            background-color: var(--success);
        }

        .toast.error {
            background-color: var(--error);
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 640px) {
            .form-card {
                padding: 24px;
            }

            .scale-row {
                flex-direction: column;
                gap: 16px;
            }

            .scale-label.right {
                text-align: left;
            }

            .scale-options {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>

    <?php if (!empty($message)): ?>
        <div id="toastNotification" class="toast <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toastNotification');
                if (toast) {
                    toast.style.transition = 'opacity 0.5s ease';
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.remove();
                        <?php if ($status === 'success') echo 'window.location.href = "Germplasm.php";'; ?>
                    }, 500);
                }
            }, 4000);
        </script>
    <?php endif; ?>
    <div class="ack-section py-4">
        <div class="container-fluid">
            <div class="ack-header bg-primary bg-opacity-10 py-4 mb-5 rounded-3 text-center">
                <h2 class="text-primary display-4 mb-2">
                    <i class="me-2"></i><strong>Feedback Form<span class="badge bg-primary fs-6 align-middle"></span></strong>
                </h2>
                <p class="lead text-muted mb-0">Fields marked with <span class="required-star">*</span> are mandatory to submit evaluation details.</p>
            </div>

            <div class="feedback-wrapper">
                <div class="form-card">
                    <div class="form-header">
                        <h2></h2>

                    </div>

                    <form id="Feedback" method="post" enctype="multipart/form-data" autocomplete="off">

                        <div class="form-group">
                            <label class="question-label" for="name">Name<span class="required-star">*</span></label>
                            <input type="text" name="name" placeholder="Enter your name" id="name" required>
                            <div class="validation-hint" id="nameHint">Name can only contain alphanumeric values or underscores.</div>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="email">Email Address<span class="required-star">*</span></label>
                            <input type="email" name="email" placeholder="Enter your email address" id="email" required>
                            <div class="validation-hint" id="emailHint">Please supply a valid standard routing email address.</div>
                        </div>

                        <div class="form-group">
                            <label class="question-label">What is your highest level of education?<span class="required-star">*</span></label>
                            <div class="grid-selector">
                                <label class="card-option">
                                    <input type="radio" name="Education" value="1" required> High school/Diploma
                                </label>
                                <label class="card-option">
                                    <input type="radio" name="Education" value="2"> Undergraduate
                                </label>
                                <label class="card-option">
                                    <input type="radio" name="Education" value="3"> Postgraduate
                                </label>
                                <label class="card-option">
                                    <input type="radio" name="Education" value="4" checked> Doctorate
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="address">University/College Name and Address<span class="required-star">*</span></label>
                            <textarea name="address" id="address" rows="4" placeholder="Enter full institutional details..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="question-label">How easy is it to use the portal?<span class="required-star">*</span></label>
                            <div class="scale-row">
                                <div class="scale-label">Difficult</div>
                                <div class="scale-options">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="scale-item">
                                            <input type="radio" id="usedatabase<?php echo $i; ?>" name="usedatabase" value="<?php echo $i; ?>" <?php echo $i === 5 ? 'checked' : ''; ?> required />
                                            <label for="usedatabase<?php echo $i; ?>"><?php echo $i; ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="scale-label right">Very Easy</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="question-label">How would you rate the quality of the portal's content?<span class="required-star">*</span></label>
                            <div class="grid-selector">
                                <label class="card-option"><input type="radio" name="Content" value="4" checked required> Excellent</label>
                                <label class="card-option"><input type="radio" name="Content" value="3"> Good</label>
                                <label class="card-option"><input type="radio" name="Content" value="2"> Fair</label>
                                <label class="card-option"><input type="radio" name="Content" value="1"> Poor</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="resource">What might you use this resource for?<span class="required-star">*</span></label>
                            <textarea name="resource" id="resource" rows="4" placeholder="Describe your operational use cases..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="question-label">How satisfied are you with the speed and performance of the portal?<span class="required-star">*</span></label>
                            <div class="scale-row">
                                <div class="scale-label">Unsatisfied</div>
                                <div class="scale-options">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="scale-item">
                                            <input type="radio" id="Howsatisfied<?php echo $i; ?>" name="Howsatisfied" value="<?php echo $i; ?>" <?php echo $i === 5 ? 'checked' : ''; ?> required />
                                            <label for="Howsatisfied<?php echo $i; ?>"><?php echo $i; ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="scale-label right">Very Satisfied</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="question-label">How often do you use this portal?<span class="required-star">*</span></label>
                            <div class="grid-selector">
                                <label class="card-option"><input type="radio" name="databaseuse" value="1" checked required> Daily</label>
                                <label class="card-option"><input type="radio" name="databaseuse" value="2"> Weekly</label>
                                <label class="card-option"><input type="radio" name="databaseuse" value="3"> Monthly</label>
                                <label class="card-option"><input type="radio" name="databaseuse" value="4"> Rarely</label>
                                <label class="card-option"><input type="radio" name="databaseuse" value="5"> First time</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="improvement">What additional features or improvements would you like to see?</label>
                            <textarea name="improvement" id="improvement" rows="3" placeholder="Optional recommendations..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="addimprove">Do you have any additional comments or suggestions?</label>
                            <textarea name="addimprove" id="addimprove" rows="3" placeholder="Optional general commentary..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="question-label" for="addimprove">Submit your data to the portal</label>
                            <textarea name="addimprove" id="addimprove" rows="3" placeholder="Optional general commentary..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="reset">Reset Form</button>
                            <button type="submit" name="submit">Submit Feedback</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php include 'footer.php'; ?>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Live Dynamic Selection States Management for Grid Selectors
                    const cardOptions = document.querySelectorAll('.card-option input[type="radio"]');
                    cardOptions.forEach(radio => {
                        radio.addEventListener('change', function() {
                            const groupName = this.getAttribute('name');
                            document.querySelectorAll(`.card-option input[name="${groupName}"]`).forEach(sibling => {
                                sibling.closest('.card-option').classList.remove('selected');
                            });
                            if (this.checked) {
                                this.closest('.card-option').classList.add('selected');
                            }
                        });
                    });

                    // Live field validation scripts
                    const nameInput = document.getElementById('name');
                    const nameHint = document.getElementById('nameHint');
                    const emailInput = document.getElementById('email');
                    const emailHint = document.getElementById('emailHint');

                    nameInput.addEventListener('input', function() {
                        const nameRegex = /^[a-zA-Z0-9_\s]+$/;
                        if (this.value.trim() === "") {
                            this.classList.remove('input-success', 'input-error');
                            nameHint.classList.remove('err');
                        } else if (!nameRegex.test(this.value)) {
                            this.classList.add('input-error');
                            this.classList.remove('input-success');
                            nameHint.classList.add('err');
                        } else {
                            this.classList.add('input-success');
                            this.classList.remove('input-error');
                            nameHint.classList.remove('err');
                        }
                    });

                    emailInput.addEventListener('input', function() {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (this.value.trim() === "") {
                            this.classList.remove('input-success', 'input-error');
                            emailHint.classList.remove('err');
                        } else if (!emailRegex.test(this.value)) {
                            this.classList.add('input-error');
                            this.classList.remove('input-success');
                            emailHint.classList.add('err');
                        } else {
                            this.classList.add('input-success');
                            this.classList.remove('input-error');
                            emailHint.classList.remove('err');
                        }
                    });

                    // Clean dynamic selections on form reset triggers
                    document.getElementById('Feedback').addEventListener('reset', function() {
                        setTimeout(() => {
                            document.querySelectorAll('.card-option').forEach(el => el.classList.remove('selected'));
                            document.querySelectorAll('.input-success, .input-error').forEach(el => el.classList.remove('input-success', 'input-error'));
                            document.querySelectorAll('.validation-hint').forEach(el => el.classList.remove('err'));
                            document.querySelectorAll('.card-option input[type="radio"]:checked').forEach(checkedRadio => {
                                checkedRadio.closest('.card-option').classList.add('selected');
                            });
                        }, 10);
                    });
                });
            </script>
</body>

</html>