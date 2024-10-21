function reverseStringAscending(str) {
    let reversed = '';
    for (let i = str.length - 1; i >= 0; i--) {
        reversed += String.fromCharCode(str.charCodeAt(i));
    }
    return reversed;
}


let originalString = "hello world";
let reversedAscending = reverseStringAscending(originalString);
console.log("original string: " + originalString);
console.log("Reversed in ascending order string: " + reversedAscending);
