<?php
// Get answer ID and customer ID from GET parameters
$answerID = $_GET['answerID'];
$customerID = $_GET['customerID'];

// Open database connection
#$db = new SQLite3('/xampp/Data/test.db');

// Get list of questions for the given answer ID
$result = $db->query("SELECT q.QuestionID, q.Question, a.Answer
    FROM Questions q
    LEFT JOIN Answers a ON q.QuestionID = a.QuestionID AND a.AnswerID = $answerID");

// Display the questions as a form
echo '<form method="POST" action="submit_audit.php">';
echo '<input type="hidden" name="answerID" value="' . $answerID . '">';
echo '<input type="hidden" name="customerID" value="' . $customerID . '">';
while ($row = $result->fetchObject()) {
    $questionID = $row->QuestionID;
    $question = $row->Question;
    $answer = $row->Answer;

    // Display the question as a label and two checkboxes for "Yes" and "No"
    echo '<div>';
    echo '<label for="question' . $questionID . '">' . $question . '</label>';
    echo '<input type="radio" id="question' . $questionID . '_yes" name="question' . $questionID . '" value="Yes"' . ($answer === 'Yes' ? ' checked' : '') . '>';
    echo '<label for="question' . $questionID . '_yes">Yes</label>';
    echo '<input type="radio" id="question' . $questionID . '_no" name="question' . $questionID . '" value="No"' . ($answer === 'No' ? ' checked' : '') . '>';
    echo '<label for="question' . $questionID . '_no">No</label>';
    echo '</div>';
}

// Display a submit button to continue the audit
echo '<button type="submit">Continue Audit</button>';
echo '</form>';

// Close database connection
$db->close();
?>
