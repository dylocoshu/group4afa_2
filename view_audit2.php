<head>
<?php require("verify_login.php")?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="view-audit_style.css">
</head>
<table>
  <thead>
    <tr>
      <th>Answer ID</th>
      <th>Date</th>
      <th>Completed</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Open database connection
    $db = new SQLite3('/xampp/Data/test.db');

    // Get list of audits with completion status
    $result = $db->query('SELECT ar.AnswerID, ar.Date, ar.CustomerID, 
        CASE WHEN COUNT(a.Answer) < COUNT(q.Question) THEN "No" ELSE "Yes" END AS Completed
        FROM Audit_Response ar
        LEFT JOIN Answers a ON ar.AnswerID = a.AnswerID
        LEFT JOIN Questions q ON a.QuestionID = q.QuestionID
        GROUP BY ar.AnswerID, ar.Date, ar.CustomerID');

    // Loop through each audit and display as a row in the table
    while ($row = $result->fetchArray()) {
        
        $answerID = $row['AnswerID'];
        $date = $row['Date'];
        $customerID = $row['CustomerID'];
        $completed = $row['Completed'] === 'Yes';
        if ($customerID == $_SESSION['businessID']){
       
        // Display audit as a row in the table
        echo "<tr>";
        echo "<td>$answerID</td>";
        echo "<td>$date</td>";
        echo "<td>" . ($completed ? "Yes" : "No") . "</td>";
        echo "<td>";
        if ($completed) {
            echo "Already completed";
        } else {
            echo "<a href='complete_audit.php?answerID=$answerID&customerID=$customerID'>Complete Audit</a>";
        }
        echo "</td>";
        echo "</tr>";
    }
    }

    // Close database connection
    $db->close();
    ?>
  </tbody>
</table>
