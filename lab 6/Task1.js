function demonstrateVariableTypes() {
    
    let numberVariable = 42;
    let stringVariable = "Hello, World!";
    let booleanVariable = true;
    let arrayVariable = [1, 2, 3];
    let objectVariable = { key: 'value' };
    let functionVariable = function () {
        console.log("This is a function.");
    };

   
    var undefinedVariable; 
    var nullVariable = null;

    
    const constantNumber = 3.14;
    const constantString = "Immutable";
    const constantArray = [4, 5, 6];



   
    console.log("let - Number:", numberVariable);
    console.log("let - String:", stringVariable);
    console.log("let - Boolean:", booleanVariable);
    console.log("let - Array:", arrayVariable);
    console.log("let - Object:", objectVariable);
    functionVariable();

    console.log("\nvar - Undefined:", undefinedVariable);
    console.log("var - Null:", nullVariable);

    console.log("\nconst - Number:", constantNumber);
    console.log("const - String:", constantString);
    console.log("const - Array:", constantArray);

}


demonstrateVariableTypes();
