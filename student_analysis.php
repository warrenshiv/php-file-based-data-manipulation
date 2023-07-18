<?php

// Function to read the dataset from a file
function readDataset($filename) {
    $dataset = [];
    $file = fopen($filename, "r");

    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode(";", trim($line));
            $employee = [
                'age' => $data[0],
                'job' => $data[1],
                'marital' => $data[2],
                'education' => $data[3],
                'default' => $data[4],
                'balance' => (int)$data[5],
                'housing' => $data[6],
                'loan' => $data[7],
                'contact' => $data[8],
                'day' => $data[9],
                'month' => $data[10],
                'duration' => $data[11],
                'campaign' => $data[12],
                'pdays' => $data[13],
                'previous' => $data[14],
                'poutcome' => $data[15],
                'y' => $data[16]
            ];
            $dataset[] = $employee;
        }
        fclose($file);
    }

    return $dataset;
}

// Function to calculate the average GPA of all employees
function calculateAverageGPA($dataset) {
    $totalGPA = 0;
    $count = 0;

    foreach ($dataset as $employee) {
        // Assuming GPA is stored in the 'balance' field
        $totalGPA += $employee['balance'];
        $count++;
    }

    if ($count > 0) {
        return $totalGPA / $count;
    } else {
        return 0;
    }
}

// Function to count the number of single employees
function countSingle($dataset) {
    $count = 0;

    foreach ($dataset as $employee) {
        if ($employee['marital'] == '"single"') {
            $count++;
        }
    }

    return $count;
}

// Function to filter and return the number of employees who have attained secondary education and have a blue-collar job
function filterByEducationAndJob($dataset) {
    $count = 0;

    foreach ($dataset as $employee) {
        if ($employee['education'] == '"secondary"' && $employee['job'] == '"blue-collar"') {
            $count++;
        }
    }

    return $count;
}

// Function to filter and return the number of employees who have attained secondary education and have a blue-collar job
function filterByEducationAndJob1($dataset) {
    $count = 0;

    foreach ($dataset as $employee) {
        if ($employee['education'] == '"tertiary"' && $employee['job'] == '"blue-collar"') {
            $count++;
        }
    }

    return $count;
}

// Read the dataset from the file
$dataset = readDataset('train.csv');

// Calculate the average GPA
$averageGPA = calculateAverageGPA($dataset);
echo "Average GPA: " . $averageGPA . PHP_EOL;

// Count and display the number of single employees
$singleCount = countSingle($dataset);
echo "Number of Single Employees: " . $singleCount . PHP_EOL;

// Count and display the number of employees with secondary education and blue-collar job
$filteredCount = filterByEducationAndJob($dataset);
echo "Number of Employees with Secondary Education and Blue-Collar Job: " . $filteredCount . PHP_EOL;

// Count and display the number of employees with secondary education and blue-collar job
$filteredCount1 = filterByEducationAndJob1($dataset);
echo "Number of Employees with Tertiary Education and Blue-Collar Job: " . $filteredCount1 . PHP_EOL;

?>
