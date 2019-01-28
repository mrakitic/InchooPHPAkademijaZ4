<?php

include_once "Employee.php";

function setString($y)
{
    do {
        echo 'Enter ', $y, ': ';
        $x = readline();
        $x = trim($x);
    } while (!(!preg_match('/[^A-Za-z]+/', $x) && strlen($x) !== 0));
    $x = ucfirst(strtolower($x));
    return $x;
}
function setDate()
{
    do {
        echo 'Enter date of birth: ';
        $d = readline();
        $date = DateTime::createFromFormat("d. m. Y", $d);
        $errors = DateTime::getLastErrors();
    } while ($errors['warning_count'] + $errors['error_count'] > 0);
    return $date;
}

function setGender()
{
    do {
        echo 'Enter your gender (m/f): ';
        $s = readline();
    } while (!($s === 'm' || $s === 'f'));
    return $s;
}
function setDecimal()
{
    do {
        echo 'Enter your monthly income ';
        $p = readline();
    } while (!preg_match('/^(0|[1-9]\d*)(\,\d+)?$/', $p));
    return $p;
}

function newEmployee()
{
    $em = new Employee();
    $em->setName(setString('name'));
    $em->setLastname(setString('lastname'));
    $em->setBirthDate(setDate());
    $em->setMonthlyIncome(setDecimal());
    $em->setGender(setGender());
    return $em;
}

function getEmployees($em)
{
    foreach ($em as $rez) {
        echo "Id: \t\t\t", $rez->getId(), "\n";
        echo "Name: \t\t\t", $rez->getName(), "\n";
        echo "Lastname: \t\t", $rez->getLastname(), "\n";
        echo "Date of birth: \t\t", $rez->getBirthdate()->format('d. m. Y'), "\n";
        echo "Monthly income: \t\t\t", $rez->getMonthlyIncome(), "\n";
        echo "Gender: \t", $rez->getGender(), "\n";
    }
}

function changeEmployee($id, $em)
{

    echo "Id: \t\t\t", $em[$id - 1]->getId(), "\n";
    echo "Ime: \t\t\t", $em[$id - 1]->getName(), "\n";
    echo "Prezime: \t\t", $em[$id - 1]->getLastname(), "\n";
    echo "Datum rodenja: \t\t", $em[$id - 1]->getBirthdate()->format('d. m. Y'), "\n";
    echo "Spol: \t\t\t", $em[$id - 1]->getGender(), "\n";
    echo "Mjesecna primanja: \t", $em[$id - 1]->getMonthlyIncome(), "\n";
    echo "Unos novih\n";
    $em[$id - 1]->setName(setString('ime'));
    $em[$id - 1]->setLastname(setString('prezime'));
    $em[$id - 1]->setBirthdate(setDate());
    $em[$id - 1]->setGender(setGender());
    $em[$id - 1]->setMonthlyIncome(setDecimal());
    return $em;
}

function deleteEmployee($id, $em)
{
    do {
        echo 'Are you sure that you want to ddelete employee with id = ', $id, ' (y/n): ';
        $x = readline();
        if ($x === 'y') {
            unset($em[$id - 1]);
            return $em;
        } elseif ($x === 'n') {
            return $em;
        } else {
            echo "Wrong entry\n";
        }
    } while (true);
}
function overallAge($em)
{
    $date = 0;
    foreach ($em as $rez) {
        $date += $rez->getAge();
    }
    $year = ($date / 365);
    $year = floor($year);
    $date = $date - $year * 365;
    $month = ($date / 30);
    $month = floor($month);
    $days = ($date % 30);
    $str = $days . ". " . $month . ". " . $year;
    return $str;
}
function averageAge($em)
{
    $date = 0;
    foreach ($em as $rez) {
        $date += $rez->getAge();
    }
    $year = ($date / 365);
    $year /= count($em);
    return $year;
}

function overallIncome($em)
{
    $m = 0;
    $f = 0;
    $paymentMale = 0;
    $paymentFemale = 0;
    foreach ($em as $rez) {
        if ($rez->getGender() === 'm') {
            $paymentMale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMonthlyIncome())), 2));
            $m++;
        } elseif ($rez->getSpol() === 'f') {
            $paymentFemale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMonthlyIncome())), 2));
            $f++;
        }
    }


}

function averageIncome($em)
{
    $m = 0;
    $f = 0;
    $paymentMale = 0;
    $paymentFemale = 0;
    foreach ($em as $rez) {
        if ($rez->getGender() === 'm') {
            $paymentMale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMonthlyIncome())), 2));
            $m++;
        } elseif ($rez->getGender() === 'f') {
            $paymentFemale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMonthlyIncome())), 2));
            $f++;
        }
    }
    $aveM = $paymentMale / $m;
    $aveF = $paymentFemale / $f;
    echo "Average male income is: ", str_replace('.', ',', $aveM), "kn\n";
    echo "Average female income is: ", str_replace('.', ',', $aveF), "kn\n";
    echo ($aveM - $aveF > 0) ? "Male earn " . str_replace('.', ',', $aveM - $aveF) . "kuna than female\n" : "Female earn " . str_replace('.', ',', $aveF - $aveM) . "kuna than male\n";
}



function mainMenu()
{
    echo "if you want the list of employees enter number 1. \n";
    echo "If you want to entry a new employee enter number 2. \n";
    echo "If you want to change data of already existing employees enter number 3. \n";
    echo "If you want to delete employee press number 4. \n" ;
    echo "If you want to see the statistic of employees press number 5. \n";
    echo "If you want to Exit press 6. \n";
}

function statisticMenu()
{
    echo "If you want to see overall age press 1\n";
    echo "If you want to see average age press 2 \n";
    echo "If you want to see overall income press 3\n";
    echo "If you want to see average income press 4\n";
    echo "If you want to exit press 5 \n";

}

$employees= [];
$bool = true;

while ($bool) {
    mainMenu();
    $yourChoice = trim(fgets(STDIN));
    if ($yourChoice === 6) {
        break;
    }

    switch ($yourChoice) {
        case 1:
            {
                getEmployees($employees);
                echo "Return to main menu? (Y/N)\n";
                if (strtolower(trim(fgets(STDIN))) !== 'y') {
                    $bool = false;
                }
                break;
            }
        case 2:
            {
                echo "Enter all data: \n";
                $employees[] = newEmployee($employees);
                break;
            }
        case 3:
            {
                echo "Enter ID of your employee:\n";
                $temp = readline();
                changeEmployee($temp, $employees);
                break;
            }
        case 4:
            {
                echo "Enter the ID of employee you want to delete: \n";
                $x = readline();
                $employees = deleteEmployee($x, $employees);
                break;

    }

        case 5:
            {
                statisticMenu();

                $x = readline();
                switch ($x) {

                    case 1:
                        echo overallAge($employees) . "\n";
                        break;
                    case 2:
                        echo averageAge($employees). "\n";
                        break;
                    case 3:
                        echo overallIncome($employees). "\n";
                        break;
                    case 4:
                        averageIncome($employees). "\n";
                        break;
                    case 5:
                        exit();
                    default:
                        echo "Not valid input!";

            }
            break;
            }
        case 6:
            {
                exit();
            }
        default:
            {
                echo "\n\nYou did not pick a number between 1-6\n\n";
            }
    }
}