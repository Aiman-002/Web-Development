let num = prompt("Enter a number");

function Table_generator(num) {
  console.log("Table of " + num);
  for (let i = 1; i <= 10; i++) {
    let tableValue = num * i;
    console.log(num + " * " + i + " = " + tableValue);
  }
}

Table_generator(num);
